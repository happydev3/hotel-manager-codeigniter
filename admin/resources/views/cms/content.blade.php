@extends('common.main')
<!-- ckeditor -->
@section('css')
<!-- {!! Html::style('public/tpdassets/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css')!!} -->
{!! Html::style('public/tpdassets/assets/summernote/summernote.css')!!}
@stop

@section('content')
<!-- Page Content Start -->

<div class="wraper container-fluid">
  <div class="page-title"> 
    <h3 class="title">CMS</h3> 
  </div>

  <div class="row">
    <div class="col-md-12">
     <div class="panel panel-default">
      @if(session('success'))
      <div class="alert alert-success">{{session('success')}}</div>
      @endif
      <div class="panel-heading">
       <h3 class="panel-title">{{$cmscontent->name}}</h3>
     </div>
     <div class="panel-body">       
       <form action="{{url('cms/content').'/'.$cmscontent->id}}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="put">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div>
         <section>
          <div class="row">      
            <div class="col-md-12"> 
              <div class="form-group"> 
                <textarea rows="20" class="summernote form-control" name="contentupdate">{{$cmscontent->content}}</textarea>            
              </div> 
            </div>
          </div>     

          <div class="row">
           <div class="col-md-12 text-left">
             <button type="submit" class="btn btn-primary">Update</button>
           </div>
         </div>
       </section>
     </div>
   </form>
 </div>
</div>
</div>
</div>                     
</div>
<!-- Page Content Ends -->   
@stop

@section('script')
<!-- {!! Html::script('public/tpdassets/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js')!!}
{!! Html::script('public/tpdassets/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js')!!} -->
{!! Html::script('public/tpdassets/assets/summernote/summernote.min.js')!!}
{!! Html::script('public/tpdassets/assets/notifications/notify.min.js')!!}
{!! Html::script('public/tpdassets/assets/notifications/notify-metro.js')!!}
{!! Html::script('public/tpdassets/assets/notifications/notifications.js')!!}
<script>
  // jQuery(document).ready(function(){
  //     $('.wysihtml5').wysihtml5();
  // });
  $('.summernote').summernote({
    height: 200,
    minHeight: null,
    maxHeight: null,
    focus: true
  });
</script>
<!-- @if(session('success'))
<script type="text/javascript">
    $.Notification.autoHideNotify('success', 'top right', 'I will be closed in 5 seconds...','Content Updated Successfully');
</script>
 @endif -->
@stop