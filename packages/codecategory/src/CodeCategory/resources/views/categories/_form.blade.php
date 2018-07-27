<div class="form-group">
{!! Form::label('Parent', 'Parent:') !!}

<select name="parent_id" id="parent_id" class="form-control" required="required">
        <option value="0"></option>
        @foreach($categories as $c)
            <option value="{{ $c->id }}"
            @if($c->id == $category->parent_id)
              selected="selected" 
            @endif
            >{{ $c->name }}</option>
        @endforeach
</select>
</div>


<div class="form-group">
   {!! Form::label('name',"Name:") !!}
   {!! Form::text('name',null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
   {!! Form::label('Active',"Active:") !!}
   {!! Form::checkbox('active',null,['class'=>'form-control']) !!}
</div>