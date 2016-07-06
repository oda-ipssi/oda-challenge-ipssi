<form method="post" action="{{ action('RoleController@store') }}" accept-charset="UTF-8">
  <input name="_token" type="hidden" value="{{ csrf_token() }}"/>

  <input type="text" class="" name="name" placeholder="Nom du rôle" />
  <input type="text" class="" name="display_name" placeholder="Label du rôle" />
  <textarea placeholder="Description du rôle" name="description"></textarea>

  <input value="Enregistrer" type="submit" />
</form>
