@layout('layouts.admin_app')

@section('scripts')
<style>
.fa-large
{
 font-size: 80px ;
}
</style>
@endsection
@section('content')
<!-- InstanceBeginEditable name="Edit1" -->
<div id="contents" class="clearfix">
    <section>
        <h3>{{__('messages.download_title')}}</h3>
        <p class="mb1">{{__('messages.download_desciprtion')}}</p>
        <h4 class="mb1">{{__('messages.download_sub_title')}}</h4>
        @foreach ($contents as $content)
        <article id="d_box">
            <div class=" inner">
                <div class="pdf">
                  <a href="{{ url($content->url) }}" target="_blank">
                    <!-- <img src="{{asset('images/img_pdf.png')}}" alt="pdf"> -->
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
                  </a>
                </div>
                <div class="text_box">
                    <h5>■{{ $content->name }}</h5>
                    <p class="pdf_name">ファイル形式：{{ $content->extension }}ファイル</p>
                    <p class="caption">{{ $content->description }}</p>
                </div>
                <div class="d_buttom"><a href="{{ url($content->url) }}" target="_blank"><img src="{{asset('images/d_buttom.png')}}" alt="ダウンロード" lang="ダウンロード"></a></div>
            </div>
        </article>
        @endforeach
</section>
</div>
@endsection
