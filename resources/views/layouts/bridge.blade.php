<x-app-layout>
    <x-slot name="header">
        @if (trim($title))
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $title ?? ' ??? no title ??? '}}
            </h2>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="font-bold p-6 bg-white border-b border-gray-200">

                    @if ($subtitle)
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h2>{{ $subtitle ?? ' ??? no subtitle ??? ' }}</h2>
                            </div>

                        </div>
                    </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{ $slot }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

