<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="row">
                        <x-d-stat-card :name="'Open Tickets'" :number="$count['open']" :type="'primary'" :icon="'envelope-open'"/>
                        <x-d-stat-card :name="'Re Open Tickets'" :number="$count['reopen']" :type="'info'" :icon="'envelope-open-text'"/>
                        <x-d-stat-card :name="'ResolvedTickets'" :number="$count['resolved']" :type="'success'" :icon="'check'"/>
                        <x-d-stat-card :name="'UnResolvedTickets'" :number="$count['unsolved']" :type="'danger'" :icon="'times'"/>
                    </div>
                    <div class="row" style="margin-top: 10px; margin-bottom:10px">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-success text-white">Graphical Views of Monthly Tickets</div>
                                <canvas id="myChart" width="400" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            {{-- <x-d-data-table :header="'Latest Tickets'"/> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_reverse($datename)) !!},
            datasets: [{
                label: '# of resolved Tickets',
                data:  {!! json_encode($solved) !!},
                backgroundColor:'rgba(75, 192, 192, 0.2)',
                borderColor:'rgba(75, 192, 192, 1)',
                borderWidth: 1
                
            },{
                label: '# of unresolved tickets',
                data:  {!! json_encode($unsolved) !!},
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>