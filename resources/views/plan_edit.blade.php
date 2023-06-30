<!DOCTYPE html>
<html lang="en">
<head>
  <title>Plan Edit</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<style type="text/css">.inln{ float:left } .time_div{ width: 12%; }
.sm{     background: #eeecec;
    padding: 5px; }
</style>
<div class="container">
  <h1>Plan Edit</h1> 
  <div class="container">

    <form id="validate" action="{{ route('plan.update',$getPlan->id) }}"  class="form-horizontal comm_form" method="POST" role="form" enctype="multipart/form-data" >
        
        @csrf
        @method('PUT') 
         <div class="row fil_ters">
           <div class="col-md-12">
              <div class="card-body">
                 <div class="row"> 
                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label>Plan Title</label>
                            <input type="text" class="form-control  validate[required]"
                             value="{{ old('plan_name') ? old('plan_name') : $getPlan->plan_name }}"
                             id="plan_name" required  name="plan_name" autocomplete="off">
                        </div> 
                    </div>        
                 </div>

                 <div class="row"> 
                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label>Selected Book</label><br/>
                            @foreach($getStudyPlanBook as $bkVal)
                                @php
                                    $dec_Arr = json_decode($bkVal->chapter_ids); 
                                    $chapters = \App\Models\BookChapter::whereIn('id',$dec_Arr)->pluck('chapter_title')->implode(','); 
                                @endphp
                                <div class="col-md-4 inln"> 
                                    <div class="form-group"> 
                                        <input readonly type="text" class="form-control"
                                         value="{{ $bkVal->plan_book_detail->book_title }}" />
                                    </div> 
                                </div>
                                <div class="col-md-8 inln"> 
                                    <div class="form-group"> 
                                        <input readonly type="text" class="form-control"
                                         value="{{ $chapters}}" />
                                    </div> 
                                </div>
                            @endforeach

                        </div> 
                    </div>        
                 </div>

                 <div class="row"> 
                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label>Select Timing</label><br/>
                            <div class="row sm" > 
                                <div class="time_div">
                                    Sunday
                                </div>
                                <div class="time_div">
                                    Monday
                                </div>
                                <div class="time_div">
                                    Tuesday
                                </div>
                                <div class="time_div">
                                    Wednesday
                                </div>
                                <div class="time_div">
                                    Thursday
                                </div>
                                <div class="time_div">
                                    Friday
                                </div>
                                <div class="time_div">
                                    Saturday
                                </div>
                            </div>
                            <div class="row sm" >
                                @for($i=1;$i<=7;$i++)
                                     
                                        <div class="time_div">
                                            <div id="timeFieldsContainer{{ $i }}">
                                                 @php
                                                    $getStudyPlanTiming = \App\Models\StudyPlanTiming::where(['study_plan_id'=>$getPlan->id,'week_day'=>$i])->first();
                                                 @endphp
                                                 @if(isset($getStudyPlanTiming->selected_time_json))
                                                        @php
                                                            $input_timing = json_decode($getStudyPlanTiming->selected_time_json); 
                                                            $tid=1;
                                                        @endphp    
                                                        @foreach($input_timing as $timeVal)  
                                                          <div class="topp_cls_div" id="topp_div_{{$tid.'_'.$i}}"> 
                                                            <input type="hidden" name="week_id[]" value="{{ $i }}" >
                                                            <input type="time" name="fromTime[]" value="{{ $timeVal[0] }}" placeholder="from time" class="timeInput"><br/> 
                                                            <input type="time" name="toTime[]" value="{{ $timeVal[1] }}" placeholder="to time" class="timeInput">

                                                            <button type="button" class="btn btn-xs btn-danger del_topping_btn" data-id="{{$tid.'_'.$i}}">x</button>
                                                          </div> 
                                                          @php $tid++; @endphp
                                                        @endforeach
                                                 @else
                                                    <div> 
                                                         <button type="button" class="addTimeField btn btn-xs btn-info" data-tid="{{ $i }}">+</button>
                                                    </div>
                                                 @endif
                                             </div>
                                         </div> 
                                @endfor
                            </div>    
                        </div> 
                    </div>        
                 </div>

                 <div class="row"> 
                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label>Duration</label><br/> 
                            <div class="col-md-4 inln"> 
                                 <label>Start Date</label>
                                <div class="form-group"> 
                                    <input type="date" class="form-control" name="start_date" value="" />
                                </div> 
                            </div>
                            <div class="col-md-4 inln"> 
                                 <label>End Date</label>
                                <div class="form-group"> 
                                    <input type="date" class="form-control" name="end_date" value="" />
                                </div> 
                            </div> 

                        </div> 
                    </div>        
                 </div>

              </div>
           </div> 
        </div> 
         
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div> 
    </form> 


    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12 bg-success">
         
      </div> 
    </div>


  </div>
</div>
    
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function() {
    $('.addTimeField').on('click', function() {
        alert("time added");
        tid = $(this).data('tid');
        dv_len = $('.topp_cls_div').length;
        data_len = dv_len+1;
        var newTimeField = '<div class="topp_cls_div" id="topp_div_'+tid+'_'+data_len+'">'+ 
              '<input type="hidden" name="week_id[]" value="'+tid+'" >'+  
              '<input type="time" name="fromTime_'+tid+'[]" class="timeInput"><br/>'+ 
              '<input type="time" name="toTime_'+tid+'[]" class="timeInput">'+
              '<button type="button" class="btn btn-xs btn-danger del_topping_btn" data-id="'+tid+'_'+data_len+'">x</button>'+
            '</div>';
          
        $('#timeFieldsContainer'+tid).append(newTimeField);
    });

    $(document).on("click", '.del_topping_btn', function(event){  // worked with dynamic loaded jquery content
             
        data_id = $(this).data('id'); 
        $('#topp_div_'+data_id).remove();
        
    });
  });
</script>
