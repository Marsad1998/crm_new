<option value="">Select option</option>
@foreach($models as $model)
    <option value="{{$model->name}}">{{$model->name}}</option>
@endforeach
