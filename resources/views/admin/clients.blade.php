<x-templates.base :title="'Clients'" :active="'client'">
    <!-- HEADER -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Panel des Clients</h1>
    </div>
    <br>

    <div class="d-flex header-bar">
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Rechercher un client" aria-label="Search">
        </form>
    </div>
    <br>

    <livewire:client />

</x-templates.base>