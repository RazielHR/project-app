@extends('layouts.main')

@section("pageTile", "Nuevo Usuario")


@section("mainContent")

    <h2>Nuevo Usuario</h2>

<form class="row g-3">
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Correo</label>
    <input type="email" class="form-control" id="inputEmail4">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Contraseña</label>
    <input type="password" class="form-control" id="inputPassword4">
  </div>
  <div class="col-6">
    <label for="inputAddress" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="Raziel">
  </div>
  <div class="col-6">
    <label for="inputAddress2" class="form-label">Apellido Paterno</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Hernandez">
  </div>
  <div class="col-6">
    <label for="inputAddress2" class="form-label">Apellido Materno</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Ramirez">
  </div>
  <div class="col-md-6">
    <label for="inputState" class="form-label">Rol</label>
    <select id="inputState" class="form-select">
      <option selected>Choose...</option>
      <option>...</option>
    </select>
  </div>

  <div class="col-12">
    <button type="submit" class="btn btn-primary">Registrar</button>
    <button type="submit" class="btn btn-danger">Cancelar</button>
  </div>
</form>
@endsection

