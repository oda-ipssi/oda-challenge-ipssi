<form method="post" action="{{ action('RoleController@store') }}" accept-charset="UTF-8">
  <input name="_token" type="hidden" value="{{ csrf_token() }}"/>

  <input type="text" class="" name="name" placeholder="Nom du rôle" />
  {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
  <input type="text" class="" name="display_name" placeholder="Label du rôle" />
  {!! $errors->first('display_name', '<small class="help-block">:message</small>') !!}
  <textarea placeholder="Description du rôle" name="description"></textarea>
  {!! $errors->first('description', '<small class="help-block">:message</small>') !!}

  <input value="Enregistrer" type="submit" />
</form>
