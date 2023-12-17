<div id="holidayModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{__('Add Holiday')}}</h5>
                <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><span
                            aria-hidden="true">×</span></button>
            </div>

            <div class="modal-body">
                <span id="holiday_form_result"></span>
                <form method="post" id="holiday_sample_form" class="form-horizontal" >

                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{__('Event Name')}} *</label>
                            <input type="text" name="event_name" id="holiday_event_name" required class="form-control"
                                   placeholder="{{__('Event Name')}}">
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('Company')}}</label>
                                <select name="company_id" id="holiday_company_id" class="form-control selectpicker"
                                        data-live-search="true" data-live-search-style="contains"
                                        title='{{__('Selecting',['key'=>trans('Company')])}}...'>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->organisatie}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('Description')}}</label>
                                <textarea class="form-control" id="holiday_description" name="description" rows="3"></textarea>
                            </div>
                        </div>



                        <div class="col-md-6 form-group">
                            <label>{{__('Start Date')}}</label>
                            <input type="text" name="start_date" id="holiday_start_date" class="form-control date" value="" required>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>{{__('End Date')}}</label>
                            <input type="text" name="end_date" id="holiday_end_date" class="form-control date" value="" required>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('Status')}}*</label>
                                <select name="is_publish" id="holiday_is_publish" class="form-control selectpicker "
                                        data-live-search="true" data-live-search-style="contains"
                                        title='{{__('Selecting',['key'=>trans('Category')])}}...'>
                                    <option value="" disabled selected>{{trans('status')}}</option>
                                    <option value="1">{{trans('published')}}</option>
                                    <option value="2">{{trans('unpublished')}}</option>
                                </select>
                            </div>
                        </div>


                        <div class="container">
                            <div class="form-group" align="center">
                                <input type="submit" name="action_button"  class="btn btn-warning" value={{trans('Add')}} />
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

