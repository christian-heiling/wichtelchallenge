<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggersForWishState extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();

        DB::unprepared(<<<SQL
CREATE FUNCTION get_presents_amount(var_wish_id INT, var_states VARCHAR(191))
	RETURNS INT
	DETERMINISTIC
BEGIN
	DECLARE var_amount INT;

	SELECT COALESCE(SUM(amount),0) INTO var_amount 
	FROM presents
	WHERE 
		wish_id = var_wish_id
		AND FIND_IN_SET(state, var_states);

	RETURN var_amount;
END;

-- SELECT get_presents_amount(145, 'done,rejected');

-- calculate_wish_state

CREATE FUNCTION calculate_wish_state(var_wish_id INT) 
	RETURNS VARCHAR(191)
	NOT DETERMINISTIC
BEGIN
	DECLARE var_delivery_done INT;
	DECLARE var_done INT;
	DECLARE var_amount INT;
	DECLARE var_unpublished INT;
	DECLARE var_overtime INT;

	SELECT amount
		INTO var_amount
		FROM wishes
		WHERE id = var_wish_id;

	SELECT published_at > NOW() or published_at IS NULL
		INTO var_unpublished
		FROM wishes
		WHERE id = var_wish_id;

	SELECT due_date < NOW()
		INTO var_overtime
		FROM wishes
		WHERE id = var_wish_id;

	SELECT get_presents_amount(var_wish_id,'delivery,done') 
		INTO var_delivery_done;

	SELECT get_presents_amount(var_wish_id,'done') 
		INTO var_done;	

	IF var_done < var_amount AND var_overtime THEN
		RETURN 'failed';
	ELSEIF var_done >= var_amount THEN
		RETURN 'success';
	ELSEIF var_unpublished THEN 
		RETURN 'unpublished';
	ELSEIF var_delivery_done >= var_amount THEN
		RETURN 'in-progress';
	ELSEIF var_delivery_done < var_amount THEN
		RETURN 'open';
	ELSE 
		RETURN 'undefined';
	END IF;
END;
SQL
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared(<<<SQL
DROP FUNCTION IF EXISTS get_presents_amount;
DROP FUNCTION IF EXISTS calculate_wish_state;
SQL
        );
    }
}
