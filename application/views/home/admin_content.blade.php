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
                    <h1 class="page-header">{{__('messages.content_title')}}</h1>
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
                                        <td>{{ $content->extension }}</td>
                                        <td>{{ $content->created_at }}</td>
                                        <td>{{ $content->description }}</td>
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
});
</script>
@endsection
