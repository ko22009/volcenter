<div class="modal-dialog">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title">
                Добавление направления
            </h4>
        </div>
        <!-- Modal Body -->
        <form id="item-form" class="form-horizontal" role="form" enctype="multipart/form-data" data-toggle="popel-validator">
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="event_type">Направление</label>
                    <div class="col-sm-10">
                        <select name="responsibilities" class="form-control" >
                            @foreach ($responsibilities as $responsibility)
                                <option value="{{ $responsibility->id }}">{{ $responsibility->position }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="submit" class="btn btn-primary" id="save_item">Сохранить</button>
            </div>
        </form>
    </div>
</div>
