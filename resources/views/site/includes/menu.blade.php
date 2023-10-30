<nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
    <a href="index.html" class="navbar-brand p-0">
        <h1 class="m-0"><i class="fa fa-user-tie me-2"></i>CanyCob</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="{{route('home.index')}}" class="nav-item nav-link
            {{ Request::routeIs('home.index')  ? 'active ' : '' }}">Home</a>
            <a href="{{route('about.index')}}" class="nav-item nav-link
            {{ Request::routeIs('about.index')  ? 'active ' : '' }}">Sobre nós</a>
            <a href="{{route('services.index')}}" class="nav-item nav-link
            {{ Request::routeIs('services.index')  ? 'active ' : '' }}">Serviços</a>
            <a href="{{route('blog.index')}}" class="nav-item nav-link
            {{ Request::routeIs('blog.index')  ? 'active ' : '' }}">Blog</a>
            <a href="{{route('plans.index')}}" class="nav-item nav-link
            {{ Request::routeIs('plans.index')  ? 'active ' : '' }}">Planos</a>
            <a href="{{route('contact.index')}}" class="nav-item nav-link
            {{ Request::routeIs('contact.index')  ? 'active ' : '' }}">Contato</a>
        </div>
{{--        <butaton type="button" class="btn text-primary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></butaton>--}}
{{--        <a href="https://htmlcodex.com/startup-company-website-template" class="btn btn-primary py-2 px-4 ms-3">Download Pro Version</a>--}}
    </div>
</nav>
