<aside class="bg-dark text-white vh-100 p-3 position-fixed sidebar" style="width: 220px;">
    <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-4 text-white text-decoration-none">
        <i class="bi bi-egg-fried fs-4 me-2"></i>
        <span class="fs-5 fw-bold">Restaurante FL</span>
    </a>

    {{-- Sección: Gestión --}}
    <span class="text-uppercase text-muted small px-3 mb-1 d-block">Gestión</span>
    <ul class="nav nav-pills flex-column mb-3">
        <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="nav-link d-flex align-items-center">
                <i class="bi bi-bar-chart me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('categorias.*') ? 'active' : '' }}">
            <a href="{{ route('categorias.index') }}" class="nav-link d-flex align-items-center">
                <i class="bi bi-folder me-2"></i> Categoría
            </a>
        </li>
        <span class="text-uppercase text-muted small px-3 mb-1 d-block">Gestión</span>
        <li class="nav-item {{ request()->routeIs('clientes.*') ? 'active' : '' }}">
            <a href="{{ route('clientes.index') }}" class="nav-link d-flex align-items-center">
                <i class="bi bi-person me-2"></i> Cliente
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('productos.*') ? 'active' : '' }}">
            <a href="{{ route('productos.index') }}" class="nav-link d-flex align-items-center">
                <i class="bi bi-box me-2"></i> Producto
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('ingredientes.*') ? 'active' : '' }}">
            <a href="{{ route('ingredientes.index') }}" class="nav-link d-flex align-items-center">
                <i class="bi bi-cup-straw me-2"></i> Ingrediente
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('proveedores.*') ? 'active' : '' }}">
            <a href="{{ route('proveedores.index') }}" class="nav-link d-flex align-items-center">
                <i class="bi bi-truck me-2"></i> Proveedor
            </a>
        </li>
    </ul>

    {{-- Sección: Operaciones --}}
    <span class="text-uppercase text-muted small px-3 mb-1 d-block">Operaciones</span>
    <ul class="nav nav-pills flex-column">
        <li class="nav-item {{ request()->routeIs('compras.*') ? 'active' : '' }}">
            <a href="{{ route('compras.index') }}" class="nav-link d-flex align-items-center">
                <i class="bi bi-cart-check me-2"></i> Compra
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('facturas.*') ? 'active' : '' }}">
            <a href="{{ route('facturas.index') }}" class="nav-link d-flex align-items-center">
                <i class="bi bi-receipt me-2"></i> Factura
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('recetas.*') ? 'active' : '' }}">
            <a href="{{ route('recetas.index') }}" class="nav-link d-flex align-items-center">
                <i class="bi bi-clipboard-data me-2"></i> Receta
            </a>
        </li>
    </ul>
    {{-- Sección: Cuenta --}}
    <hr class="my-3 border-light">

    <div class="logout-wrapper mt-auto px-3">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn w-100 d-flex align-items-center justify-content-center gap-2 logout-btn">
                <i class="bi bi-box-arrow-right fs-5"></i>
                <span class="fw-semibold">Cerrar Sesión</span>
            </button>
        </form>
    </div>


</aside>
