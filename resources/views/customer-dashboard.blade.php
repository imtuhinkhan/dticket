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
                        <x-d-stat-card :name="'ResolvedTickets'" :number="$count['resolved']" :type="'success'" :icon="'calender-check'"/>
                        <x-d-stat-card :name="'UnResolvedTickets'" :number="$count['unsolved']" :type="'danger'" :icon="'calender-times'"/>
                    </div>
                    <div class="row" style="margin-top: 10px; margin-bottom:10px">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-success text-white">Graphical Views of Tickets Support</div>
                                <div height="100px">
                                    <canvas id="myChart" style="display: block; box-sizing: border-box; height: 500.6px!imortant; width: 500.6px!imortant;"></canvas>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                        <div class="card-header bg-success text-white">All My Ticket</div>
                        @include('ticket.table')
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
        type: 'pie',
        data: {
            labels: ['Solved','Unsolved'],
            datasets: [{
                label: '# of resolved Tickets',
                data:  {!! json_encode($data) !!},
                backgroundColor:['#ef5350','#66bb6a'],
                borderWidth: 1
                
            }]
        },
        options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
        legend: {
            position: 'top',
        },
        title: {
            display: true,
            text: 'Graphical Views of Tickets Support'
        }
        }
    },
    });
    </script>