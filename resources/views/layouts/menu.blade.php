@if(\App\Patrones\Permiso::esAdministrador())
    <li class="{{ Request::is('users*') ? 'active' : '' }}">
        <a href="{!! route('users.index') !!}"><i class="fa fa-user"></i><span>Usuarios</span></a>
    </li>
@endif

<li class="{{ Request::is('products*') ? 'active' : '' }}">
    <a href="{!! route('products.index') !!}"><i class="fa fa-list"></i><span>Productos</span></a>
</li>

<li class="{{ Request::is('clients*') ? 'active' : '' }}">
    <a href="{!! route('clients.index') !!}"><i class="fa fa-users"></i><span>Clientes</span></a>
</li>

<li class="{{ Request::is('sales*') ? 'active' : '' }}">
    <a href="{!! route('sales.index') !!}"><i class="fa fa-edit"></i><span>Sales</span></a>
</li>

<li class="{{ Request::is('details*') ? 'active' : '' }}">
    <a href="{!! route('details.index') !!}"><i class="fa fa-edit"></i><span>Details</span></a>
</li>

