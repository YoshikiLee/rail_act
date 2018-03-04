@layout('layouts.admin_app')

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
                <div class="pdf"><a href="{{ url($content->url) }}" target="_blank"><img src="{{asset('images/img_pdf.png')}}" alt="pdf"></a></div>
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
