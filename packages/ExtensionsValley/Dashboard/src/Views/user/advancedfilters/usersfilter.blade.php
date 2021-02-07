<div class="col-md-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Advanced Search Filter</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            {!!Form::open(array('url' => Request::url(), 'method' => 'get')) !!}

            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                {!! Form::label('filter_group', 'User Groups') !!}
                {!! Form::select('filter_group', array('0'=>'--Select--') + ExtensionsValley\Dashboard\Models\Group::getGroups()->toArray(), request()->has('filter_group') ? request()->get('filter_group') : '', [
                    'class'       => 'form-control select2',
              ]) !!}
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                {!! Form::label('filter_status', 'User Status') !!}
                {!! Form::select('filter_status', array('-1'=>'--Select--','0' => 'Unpublished','1' => 'Published')  ,request()->has('filter_status') ? request()->get('filter_status') : '' , [
                    'class'       => 'form-control js-example-responsive filter_status select2',
                ]) !!}
            </div>
          
                <div class="col-md-4 col-sm-6 col-xs-12 form-group"><br/>
                    <a href="{{Request::url()}}" class="btn btn-primary">Clear</a>
                    <button type="submit" class="btn btn-success">Filter</button>
                </div>
           

            {!! Form::token() !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
