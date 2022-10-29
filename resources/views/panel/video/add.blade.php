@extends('panel.layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('public/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <form role="form" action="{{ route('video-create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</b></h3>
                            </div>
                            <div class="card-body form-data-role">
                                @include('panel.layouts.alert')
                                @include('panel.layouts.validation')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputSuccess">Title <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                                                </div>
                                                <input type="text" id="title" name="title" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Video Link</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="link">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-link"></i></span>
                                                </div>
                                            </div>
                                            <img class="icon_image" src="" style="margin-top:5px;border:2px solid black; border-radius:5px" hidden>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputSuccess">Status <span
                                                    class="text-danger">*</span></span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-user-plus"></i></span>
                                                </div>
                                                <select class="form-control" id="status" name="status"
                                                    style="width: 100%;">
                                                    <option selected="selected" disabled>-- Select Status --</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Deactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Other</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="other">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-file"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description <span class="text-danger">*</span></label>
                                        <textarea class="textarea form-control" rows="3" name="description" placeholder="Describe about the video ..."
                                            style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <input type="submit" class="btn btn-info" name="submit" value="Submit" />
                            <input type="reset" class="btn btn-danger" name="reset" value="Reset" />
                        </div>
                    </div>
                </div>
        </div>
        </form>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ asset('public/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <script src="{{ asset('public/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('public/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('public/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('public/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    {{-- <script src="{{ asset('public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('public/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>v --}}

    <script>
        $('.select2').select2();
        $(document).ready(function() {
            bsCustomFileInput.init();
        });
        $('.duallistbox').bootstrapDualListbox();
        $('.duallistboxroles').bootstrapDualListbox();
        $('[data-mask]').inputmask();
        $(function() {
            // Summernote
            $('.textarea').summernote();

            //color picker with addon
            $('.my-colorpicker2').colorpicker()
            $('.my-colorpicker2').on('colorpickerChange', function(event) {
                $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
            });
        });
        $('input[name = "link"]').on("change blur", function(){
            preview_image(getScreen($(this).val(), null));
        });
        function getScreen( url, size )
        {
            if(url === null){ return ""; }
            size = (size === null) ? "big" : size;
            var vid;
            var results;
            results = url.match("[\\?&]v=([^&#]*)");
            vid = ( results === null ) ? url : results[1];
            if (size == "small"){
                return "http://img.youtube.com/vi/"+vid+"/2.jpg";
            } else {
                return "http://img.youtube.com/vi/"+vid+"/0.jpg";
            }
        };
        function preview_image(image_url) {
            $(".icon_image").prop('hidden', false);
            $(".icon_image").attr("src",image_url);
        }
    </script>
@endsection
