<form id="search-form" action="/search" method="GET">
    <div class="input-group">
        <input class="input-group-field" name="keywords" type="search" value="{{ \Request::get('keywords') }}" placeholder="Ich suche nach ..."/>
        <div class="input-group-button">
            <input type="submit" class="button dark" value="Suchen">
        </div>
    </div>
</form>