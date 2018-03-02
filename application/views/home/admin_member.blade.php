@layout('layouts.kanri_app')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{__('messages.member_title')}}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{__('messages.member_list_title')}}</div>
                <!-- .panel-heading -->
                <div class="panel-body">
                    <div class="panel-group" id="accordion">
                        @foreach ($users as $user)
                        <div class="panel{{ $user->isadmin ? ' panel-yellow' : ' panel-green' }}">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $user->id }}">{{ $user->username }}</a>
                                </h4>
                            </div>
                            <div id="collapse{{ $user->id }}" class="panel-collapse collapse{{ $user->id == $minid ? ' in' : '' }}">
                                <div class="panel-body">
                                  <div class="table-responsive">
                                      <table class="table table-bordered table-striped">
                                          <tbody>
                                              <tr>
                                                  <th width="300">{{__('messages.member_name')}}</th>
                                                  <td>{{ $user->username }}</td>
                                              </tr>
                                              <tr>
                                                  <th>{{__('messages.member_type')}}</th>
                                                  <td>{{ $user->isadmin ? __('messages.administrator') : __('messages.member') }}</td>
                                              </tr>
                                              <tr>
                                                  <th>{{__('messages.member_password')}}</th>
                                                  <td>
                                                      <div id="showChange">
                                                        <button id="showChangeBotton" type="button" class="btn btn-danger btn-sm">{{__('messages.member_password_change')}}</button>
                                                      </div>
                                                      <div id="showChange" class="input-group" style="display: none;">
                                                        <input type="password" class="form-control" placeholder="{{__('messages.member_password_input')}}" maxlength=32 autocomplete=OFF>
                                                        <span class="input-group-btn">
                                                          <button id="confirmChangeBotton" class="btn btn-danger btn-secondary" type="button">{{__('messages.member_password_change')}}</button>
                                                        </span>
                                                      </div>
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <th>{{__('messages.member_lastupdated')}}</th>
                                                  <td>{{ $user->updated_at }}</td>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- .panel-body -->
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
  $('#showChangeBotton').click(function(e) {
    e.preventDefault();
    $('div#showChange').toggle('500');
  });
  $('#confirmChangeBotton').click(function(e) {
    e.preventDefault();
    BootstrapDialog.confirm({
      title: '{{__('messages.member_password_change_confirm_title')}}',
      message: '{{__('messages.member_password_change_confirm')}}',
      type: BootstrapDialog.TYPE_DANGER,
      closable: true,
      draggable: false,
      btnCancelLabel: '{{__('messages.member_password_change_cancel')}}',
      btnOKLabel: '{{__('messages.member_password_change_process')}}',
      btnOKClass: 'btn-danger',
      callback: function(result) {
        if(result){
          App.ajax({
              url: '{{ url('logout') }}',
              data: {
              },
              sk_success: function (data, textStatus, jqXHR) {
                  $('div#showChange').toggle('500');
              }
          });
        }
      }
    });
  });
});
</script>
@endsection
