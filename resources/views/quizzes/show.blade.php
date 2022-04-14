<x-quizzes-layout>

    <x-slot name="subtitle">Show quiz (ID: {{ $quiz->id }})</x-slot>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $quiz->name }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $quiz->description }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Deal constraints:</strong>
                <ul style="list-style-type: disc; margin-left: 30px">
                    @foreach ($quiz->deal_constraint->constraints_human as $constraint)
                        <li>{!! $constraint['name']  !!} {{ $constraint['value'] }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                Vulnerable NS: {{ $quiz->deal_constraint->vulnerable_ns_human }}<br />
                Vulnerable WE: {{ $quiz->deal_constraint->vulnerable_we_human }}<br />
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Deals count:</strong>
                {{ $quiz->deals_count }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Deals:</strong>
                <table class="table table-bordered">
                    <tr>
                        <th>Data</th>
                        <th>Cards</th>
                        <th>Action</th>
                    </tr>
                    @each('deals.index_item', $quiz->deals()->get(), 'deal')
                    </table>
            </div>
        </div>

    </div>
</x-quizzes-layout>
