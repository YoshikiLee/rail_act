@layout('layouts.kanri_app')

@section('scripts')
<style>
table.dataTable tbody tr.selected {
background-color: #B0BED9;
}
</style>
@endsection

@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">{{__('messages.history_title')}}</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{__('messages.history_list_title')}}</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-download">
                                <thead>
                                    <tr>
                                        <th>{{__('messages.history_list_no')}}</th>
                                        <th>{{__('messages.history_list_username')}}</th>
                                        <th>{{__('messages.history_list_filename')}}</th>
                                        <th>{{__('messages.history_list_fileextension')}}</th>
                                        <th>{{__('messages.history_list_isopen')}}</th>
                                        <th>{{__('messages.history_list_date')}}</th>
                                    </tr>
                                </thead>
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
    var table = $('#dataTables-download').DataTable({
      "ajax":{
        "url" : "{{ url('admin/history/list') }}",
        "dataSrc" : ""
      },
      "order": [[ 5, "desc" ]],
      "columns": [
        { "data": "id" },
        { "data": "username" },
        { "data": "filename" },
        { "data": "fileextension" },
        { "data": "isopen" },
        { "data": "created_at" }
      ],
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

    $('#dataTables-download tbody').on( 'click', 'tr', function () {
      $(this).toggleClass('selected');
    });

    $('#button-delete').click( function (e) {
      e.preventDefault();
      if (table.rows('.selected').data().length > 0) {
        BootstrapDialog.confirm({
          title: '{{__('messages.history_delete_title')}}',
          message: '{{__('messages.history_delete_confirm')}}',
          type: BootstrapDialog.TYPE_DANGER,
          closable: true,
          draggable: false,
          btnCancelLabel: '{{__('messages.cancel')}}',
          btnOKLabel: '{{__('messages.delete')}}',
          btnOKClass: 'btn-danger',
          callback: function(result) {
            if(result){
              var ids = '';
              for (var i = 0; i < table.rows('.selected').data().length; i++) {
                ids += table.rows('.selected').data()[i]["id"];
                if (i+1 < table.rows('.selected').data().length) {
                  ids += ',';
                }
              }
              App.ajax({
                  url: '{{ url('admin/history/delete') }}',
                  data: {
                    'ids':ids
                  },
                  app_success: function (data, textStatus, jqXHR) {
                    if(data['success']){
                      table.ajax.reload();
                      BootstrapDialog.show({
                          type: BootstrapDialog.TYPE_PRIMARY,
                          title: '{{__('messages.success')}}',
                          message: '{{__('messages.history_delete_finish')}}'
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
</script>
@endsection
