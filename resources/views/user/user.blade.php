<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(ucfirst(explode("/",$tag)[1])) }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="row">
                        <div class="col-12">
                            <x-d-data-table 
                            :header="'User'"
                            :theader='$theader'
                            :data='$userList'
                            :tag='$tag'
                            :add-new='1'
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>