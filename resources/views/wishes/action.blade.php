<div class="col-md-12 text-center">
    <div class="btn-group" role="group">
        @can('read', $wish)
            @if ($action == 'browse')
                <a href="{{  route('voyager.wishes.show', ['id' => $wish->id]) }}" class="btn btn-default" title="Anzeigen">
                    <i class="voyager-eye"></i>
                    Anzeigen
                </a>
            @endif
        @endcan
        @can('add', new \App\Present(['wish_id' => $wish->id]))
            <a href="{{  route('voyager.presents.create', ['id' => $wish->id]) }}" class="btn btn-default" title="Wunsch erfüllen">
                <i class="voyager-gift"></i>
                Wunsch erfüllen
            </a>
        @endcan

        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="voyager-dot-3"></i>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                @can('publish', $wish)
                    <li>
                        <a href="{{  route('voyager.wishes.publish', ['id' => $wish->id]) }}">
                            <i class="voyager-play"></i>
                            Veröffentlichen
                        </a>
                    </li>
                @endcan
                @can('unpublish', $wish)
                    <li>
                        <a href="{{  route('voyager.wishes.unpublish', ['id' => $wish->id]) }}">
                            <i class="voyager-pause"></i>
                            Verbergen
                        </a>
                    </li>
                @endcan
                @can('edit', $wish)
                    <li>
                        <a href="{{  route('voyager.wishes.edit', ['id' => $wish->id]) }}">
                            <i class="voyager-edit"></i>
                            Bearbeiten
                        </a>
                    </li>
                @endcan
                @can('delete', $wish)
                    <li>
                        <a href="javascript:;" title="Löschen" class="delete" data-id="{{ $wish->id }}" id="delete-194">
                            <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Löschen</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
