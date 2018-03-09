@layout('layouts.kanri_app')

@section('scripts')
<style>
table.dataTable tbody tr.selected {
background-color: #B0BED9;
}

.fa-large
{
	font-size: 30px ;
}
</style>
@endsection

@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">{{__('messages.content_title')}}</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
						<div class="row">
								<div class="col-lg-12">
										<div class="panel panel-default">
												<div class="panel-heading">{{__('messages.content_upload_title')}}</div>
												<!-- /.panel-heading -->
												<div class="panel-body">
													{{Form::open()}}
													{{Form::token()}}
													<!-- The fileinput-button span is used to style the file input field as button -->
											    <span class="btn btn-success fileinput-button">
											        <i class="glyphicon glyphicon-plus"></i>
											        <span>ファイル選択</span>
											        <!-- The file input field used as target for the file upload widget -->
											        <input id="fileupload" type="file" name="files[]" multiple>
											    </span>
													<button id="fire" class="btn btn-primary" type="button">{{__('messages.upload')}}</button>
													<button id="allcancel" class="btn btn-warning" type="button">{{__('messages.cancel')}}</button>
											    <br>
											    <br>
											    <!-- The global progress bar -->
											    <div id="progress" class="progress">
											        <div class="progress-bar progress-bar-success progress-bar-striped active"></div>
											    </div>
											    <!-- The container for the uploaded files -->
													<textarea id="files" class="form-control" rows="5" readonly></textarea>
													{{Form::close()}}
												</div>
												<!-- /.panel-body -->
										</div>
										<!-- /.panel -->
								</div>
								<!-- /.col-lg-12 -->
						</div>
						<!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{__('messages.content_list_title')}}</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-content">
                                <thead>
                                    <tr>
                                        <th>{{__('messages.content_list_no')}}</th>
                                        <th>{{__('messages.content_list_name')}}</th>
                                        <th>{{__('messages.content_list_extension')}}</th>
                                        <th>{{__('messages.content_list_uploaddate')}}</th>
                                        <th>{{__('messages.content_list_description')}}</th>
                                        <th>{{__('messages.content_list_order')}}</th>
                                        <th>{{__('messages.content_list_type')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contents as $content)
                                    <tr>
                                        <td>{{ $content->id }}</td>
                                        <td>{{ $content->name }}</td>
                                        <td>
                                          @if ( $content->extension == 'xlsx' || $content->extension == 'xlsm' || $content->extension == 'xls' )
                                              <i class="fa fa-file-excel-o fa-large"></i>
                                          @elseif ( $content->extension == 'pdf' )
                                              <i class="fa fa-file-pdf-o fa-large"></i>
                                          @elseif ( $content->extension == 'pptx' || $content->extension == 'pptm' || $content->extension == 'ppt' )
                                              <i class="fa fa-file-powerpoint-o fa-large"></i>
                                          @elseif ( $content->extension == 'jpg' || $content->extension == 'jpeg' )
                                              <i class="fa fa-file-image-o fa-large"></i>
                                          @elseif ( $content->extension == 'docx' || $content->extension == 'docm' || $content->extension == 'doc' )
                                              <i class="fa fa-file-word-o fa-large"></i>
                                          @else
                                              <i class="fa fa-file-o fa-large"></i>
                                          @endif
                                        </td>
                                        <td>{{ $content->created_at }}</td>
                                        <td><input type="text" class="form-control" value="{{ $content->description }}" id="{{ $content->id }}" name="description" maxlength="20"></td>
                                        <td><input type="text" class="form-control" value="{{ $content->order }}" id="{{ $content->id }}" name="order" maxlength="10"></td>
                                        <td>
                                            <select class="form-control" id="{{ $content->id }}" name="isopen{{ $content->id }}">
                                              <option value="0" {{ $content->isopen ? 'selected' : '' }}>
                                                  公開
                                              </option>
                                              <option value="1" {{ $content->isopen ? 'selected' : '' }}>
                                                  非公開
                                              </option>
                                            </select>
                                        </td>
                                   </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
						<div class="row">
								<div class="col-xs-12">
										<div class="text-right">
												<button id="button-delete" type="button" class="btn btn-danger btn-block" style="margin-bottom: 5px">{{__('messages.delete')}}</button>
										</div>
								</div>
								<!-- /.col-xs-12 -->
						</div>
						<!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
@endsection

@section('javascript')
<script type="text/javascript">
$(document).ready(function() {
    var table = $('#dataTables-content').DataTable({
      "order": [[ 3, "desc" ]],
      "language": {
        "sEmptyTable":     "テーブルにデータがありません",
        "sInfo":           " _TOTAL_ 件中 _START_ から _END_ まで表示",
        "sInfoEmpty":      " 0 件中 0 から 0 まで表示",
        "sInfoFiltered":   "（全 _MAX_ 件より抽出）",
        "sInfoPostFix":    "",
        "sInfoThousands":  ",",
        "sLengthMenu":     "_MENU_ 件表示",
        "sLoadingRecords": "読み込み中...",
        "sProcessing":     "処理中...",
        "sSearch":         "検索:",
        "sZeroRecords":    "一致するレコードがありません",
        "oPaginate": {
          "sFirst":    "先頭",
          "sLast":     "最終",
          "sNext":     "次",
          "sPrevious": "前"
        },
        "oAria": {
          "sSortAscending":  ": 列を昇順に並べ替えるにはアクティブにする",
          "sSortDescending": ": 列を降順に並べ替えるにはアクティブにする"
        }
      }
    });

    $('#dataTables-content tbody').on( 'click', 'tr', function () {
      $(this).toggleClass('selected');
    });

    table.$('select').change( function(e) {
      e.preventDefault();
      var id = $(this).attr("id");
      var isopen = $(this).val();
      App.ajax({
          url: '{{ url('admin/content/isopen') }}',
          data: {
            'id':id,
            'isopen':isopen
          },
          app_success: function (data, textStatus, jqXHR) {
            if(!data['success']){
              BootstrapDialog.show({
                  type: BootstrapDialog.TYPE_DANGER,
                  title: '{{__('messages.error')}}',
                  message: data['message'],
                  buttons: [{
                      label: '{{__('messages.close')}}',
                      cssClass: 'btn-default',
                      action: function(dialogItself){
                          dialogItself.close();
                      }
                  }]
              });
            }
          }
      });
    });

    table.$('input[name="order"]').change( function(e) {
      e.preventDefault();
      var id = $(this).attr("id");
      var order = $(this).val();
      App.ajax({
          url: '{{ url('admin/content/order') }}',
          data: {
            'id':id,
            'order':order
          },
          app_success: function (data, textStatus, jqXHR) {
            if(!data['success']){
              BootstrapDialog.show({
                  type: BootstrapDialog.TYPE_DANGER,
                  title: '{{__('messages.error')}}',
                  message: data['message'],
                  buttons: [{
                      label: '{{__('messages.close')}}',
                      cssClass: 'btn-default',
                      action: function(dialogItself){
                          dialogItself.close();
                      }
                  }]
              });
            }
          }
      });
    });

    table.$('input[name="description"]').change( function(e) {
      e.preventDefault();
      var id = $(this).attr("id");
      var description = $(this).val();
      App.ajax({
          url: '{{ url('admin/content/description') }}',
          data: {
            'id':id,
            'description':description
          },
          app_success: function (data, textStatus, jqXHR) {
            if(!data['success']){
              BootstrapDialog.show({
                  type: BootstrapDialog.TYPE_DANGER,
                  title: '{{__('messages.error')}}',
                  message: data['message'],
                  buttons: [{
                      label: '{{__('messages.close')}}',
                      cssClass: 'btn-default',
                      action: function(dialogItself){
                          dialogItself.close();
                      }
                  }]
              });
            }
          }
      });
    });

		$('#button-delete').click( function (e) {
      e.preventDefault();
      if (table.rows('.selected').data().length > 0) {
        BootstrapDialog.confirm({
          title: '{{__('messages.content_delete_title')}}',
          message: '{{__('messages.content_delete_confirm')}}',
          type: BootstrapDialog.TYPE_DANGER,
          closable: true,
          draggable: false,
          btnCancelLabel: '{{__('messages.cancel')}}',
          btnOKLabel: '{{__('messages.delete')}}',
          btnOKClass: 'btn-danger',
          callback: function(result) {
            if(result){
              var ids = [];
              for (var i = 0; i < table.rows('.selected').data().length; i++) {
                ids.push(table.rows('.selected').data()[i][0]);
              }
              App.ajax({
                  url: '{{ url('admin/content/delete') }}',
                  data: {
                    'ids':ids
                  },
                  app_success: function (data, textStatus, jqXHR) {
                    if(data['success']){
											table.rows('.selected').remove().draw();
                      BootstrapDialog.show({
                          type: BootstrapDialog.TYPE_PRIMARY,
                          title: '{{__('messages.success')}}',
                          message: '{{__('messages.content_delete_finish')}}'
                      });
                    } else {
                      BootstrapDialog.show({
                          type: BootstrapDialog.TYPE_DANGER,
                          title: '{{__('messages.error')}}',
                          message: data['message'],
                          buttons: [{
                              label: '{{__('messages.close')}}',
                              cssClass: 'btn-default',
                              action: function(dialogItself){
                                  dialogItself.close();
                              }
                          }]
                      });
                    }
                  }
              });
            }
          }
        });
      }
    });

});
$(document).ready(function() {
    'use strict';
    $('#fileupload').fileupload({
        url: '{{ url('admin/content/upload') }}',
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo('#files');
								var txt = $("textarea#files");
								txt.val( txt.val() + file.name + "\n");
            });
        },
				fail: function (e, data) {
					$('#progress .progress-bar').css('width', 0);
					$('#progress .progress-bar').html('');
					BootstrapDialog.show({
							type: BootstrapDialog.TYPE_DANGER,
							title: '{{__('messages.error')}}',
							message: data['errorThrown'],
							buttons: [{
									label: '{{__('messages.close')}}',
									cssClass: 'btn-default',
									action: function(dialogItself){
											dialogItself.close();
									}
							}]
					});
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');

		$("#allcancel").click(function(e) {
				e.preventDefault();
				var names = $('#files').val().replace(/\r?\n/g,",").slice(0, -1).split(",");
				$('#progress .progress-bar').css('width', 0);
				$('#progress .progress-bar').html('');
				$('#files').val('');
				App.ajax({
					url: '{{ url('admin/content/deleteUploadFile') }}',
					data: {
						'names':names
					},
					app_success: function (data, textStatus, jqXHR) {
						if(data['success']){
							BootstrapDialog.show({
									type: BootstrapDialog.TYPE_PRIMARY,
									title: '{{__('messages.success')}}',
									message: '{{__('messages.content_upload_cancel_finish')}}'
							});
						} else {
							BootstrapDialog.show({
									type: BootstrapDialog.TYPE_DANGER,
									title: '{{__('messages.error')}}',
									message: data['message'],
									buttons: [{
											label: '{{__('messages.close')}}',
											cssClass: 'btn-default',
											action: function(dialogItself){
													dialogItself.close();
											}
									}]
							});
						}
					}
        });
		});

		$("#fire").click(function(e) {
			e.preventDefault();
			var names = $('#files').val().replace(/\r?\n/g,",").slice(0, -1).split(",");
			if (names.length > 0) {
				App.ajax({
						url: '{{ url('admin/content/regist') }}',
						data: {
							'names':names
						},
						app_success: function (data, textStatus, jqXHR) {
							if(data['success']){
								setTimeout("location.reload()",1000);
								BootstrapDialog.show({
										type: BootstrapDialog.TYPE_PRIMARY,
										title: '{{__('messages.success')}}',
										message: '{{__('messages.content_upload_finish')}}'
								});
							} else {
								BootstrapDialog.show({
										type: BootstrapDialog.TYPE_DANGER,
										title: '{{__('messages.error')}}',
										message: data['message'],
										buttons: [{
												label: '{{__('messages.close')}}',
												cssClass: 'btn-default',
												action: function(dialogItself){
														dialogItself.close();
												}
										}]
								});
							}
						}
				});
			}
		});
});
</script>
@endsection
