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
                  <a href="{{ url($content->url) }}">
                    @if ( $content->extension == 'xlsx' || $content->extension == 'xlsm' || $content->extension == 'xls' )
                      <img src="{{asset('images/if_Excel.png')}}" alt="xls">
                    @elseif ( $content->extension == 'pdf' )
                      <img src="{{asset('images/if_pdf.png')}}" alt="pdf">
                    @elseif ( $content->extension == 'pptx' || $content->extension == 'pptm' || $content->extension == 'ppt' )
                      <img src="{{asset('images/if_PowerPoint.png')}}" alt="ppt">
                    @elseif ( $content->extension == 'jpg' || $content->extension == 'jpeg' )
                      <img src="{{asset('images/if_image-jpeg.png')}}" alt="jpg">
                    @elseif ( $content->extension == 'docx' || $content->extension == 'docm' || $content->extension == 'doc' )
                      <img src="{{asset('images/if_Word.png')}}" alt="doc">
                    @else
                      <img src="{{asset('images/if_Document.png')}}" alt="txt">
                    @endif
                  </a>
                </div>
                <div class="text_box">
                    <h5>■{{ $content->name }}</h5>
                    <p class="pdf_name">ファイル形式：{{ $content->extension }}ファイル</p>
                    <p class="caption">{{ $content->description }}</p>
                </div>
                <div class="d_buttom"><a href="{{ url($content->url) }}"><img src="{{asset('images/d_buttom.png')}}" alt="ダウンロード" lang="ダウンロード"></a></div>
            </div>
        </article>
        @endforeach
</section>
</div>
@endsection
