<x-templates.base :title="'Tableau de bord'" :active="'dashbord'">
    <!-- HEADER -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tableau de board</h1>
    </div>

    <!-- CANVAS -->
    <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

    <!-- LES STATISTIQUES -->
    <br>
    <h2>STATISTIQUES</h2>
    <livewire:dashbord />
    
</x-templates.base>