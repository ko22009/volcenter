<div class="modal-dialog">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title">
                @if ($event->id)
                    Редактирование мероприятия
                @else
                    Создание мероприятия
                @endif
            </h4>
        </div>
        <!-- Modal Body -->
        <form id="item-form" class="form-horizontal" role="form" enctype="multipart/form-data" data-toggle="popel-validator">
            <div class="modal-body">
                <input type="hidden" name="id" value="{{ $event->id }}">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">Название</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" value="{{ $event->name }}" data-rules="not-empty" name="name" placeholder="Название"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="descr">Описание</label>
                    <div class="col-sm-10">
                        <textarea rows="6" class="form-control" id="descr" name="descr" data-rules="not-empty" placeholder="Описание">{{ $event->descr }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">Адрес</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="address" name="address" data-rules="not-empty" placeholder="Адрес">{{ $event->address }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="event_type">Тип мероприятия</label>
                    <div class="col-sm-10">
                        <select name="event_type" class="form-control" >
                            @foreach ($event_types as $type)
                                <option value="{{ $type->id }}" @if ($type->id === $event->event_type) selected @endif>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label class="col-sm-4 control-label" for="name">Начало</label>
                        <div class="col-sm-8">
                            <div class='input-group date' id='event_start'>
                                <input type='text' class="form-control" name="event_start" value="{{ $event->event_start }}" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label class="col-sm-4 control-label" for="name">Окончание</label>
                        <div class="col-sm-8">
                            <div class='input-group date' id='event_stop'>
                                <input type='text' class="form-control" name="event_stop" value="{{ $event->event_stop }}" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-12" id="file_uploaded" style="text-align: center;">
                    <input type="hidden" name="image" value="{{ $event->image }}" />
                    @if ($event->image)
                        <image src="/bin/img/events/{{ $event->image }}" width="200px" style="margin-top: 10px" />
                        <a href="#" id="delete_img">Удалить</a>
                    @endif
                </div>
                <div class="form-group col-sm-12">
                    <input id="image" type="file" multiple class="image file-loading" data-show-preview="false" data-show-upload="false">
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
<script type="text/javascript">
    $(function () {
        $('#event_start, #event_stop').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        var $input = $("#image");
        $input.fileinput({
            'allowedFileExtensions' : ['jpg', 'jpeg', 'png'],
            'maxFileSize': 5120,
            'maxFileCount': 1,
            uploadUrl: "/adminpanel/events?action=save_img", // server upload action
            uploadAsync: false,
            showUpload: false, // hide upload button
            showRemove: false // hide remove button
        }).on("filebatchselected", function(event, files) {
            $input.fileinput("upload");
            var old_img = $("form#item-form [name=image]").val();
            if (old_img) {
                App.ajax({action: 'delete_img', old_img: old_img});
            }
        }).on('filebatchuploadsuccess', function(event, data, previewId, index) {
            $("#file_uploaded").html(
                "<input type='hidden' name='image' value='" + data.jqXHR.responseJSON.filename + "'/>" +
                " <image src='/bin/img/events/" + data.jqXHR.responseJSON.filename + "' width='200px' style='margin-top: 10px'> " +
                " <a href='#' id='delete_img'>Удалить</a>"
            );
            deleteEventImg();
        });

        deleteEventImg();
    });

    //delete img
    function deleteEventImg()
    {
        $("#delete_img").on('click', function (_el) {
            _el.preventDefault();
            notie.confirm('Вы действительно хотите удалить картинку?', 'Да', 'Отменить', function() {
                App.ajax({action: 'delete_img', old_img: $("form#item-form [name=image]").val()}, function(data) {
                    if (data.success) {
                        $("#file_uploaded").html("<input type='hidden' name='image' value=''>");
                    }
                });
            });
        });
    }
</script>
