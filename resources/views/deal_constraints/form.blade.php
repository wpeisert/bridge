@php
    $formAction = $formAction ?? '';
@endphp

@if ($formAction === 'update')
<form action="{{ route('deal_constraints.update',$dealConstraint->id) }}" method="POST">
    @csrf
    @method('PUT')
@elseif (($formAction === 'store'))
<form action="{{ route('deal_constraints.store') }}" method="POST">
    @csrf
@else
    <form>
        <fieldset disabled="disabled">
@endif

    <div class="row">
        @if (isset($dealConstraint))
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ID: </strong>
                {{ $dealConstraint->id ?? '' }}
            </div>
        </div>
        @endif

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input class="form-control" name="name" value="{{ $dealConstraint->name ?? '' }}" />
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea name="description" class="form-control" style="height:100px" placeholder="Description">{{ $dealConstraint->description ?? '' }}</textarea>
            </div>
        </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Vulnerable NS:</strong>
                    <select class="form-control" name="vulnerable_NS">
                        @foreach ($DEAL_CONSTRAINTS_VULNERABLE as $value => $text)
                            <option value="{{ $value }}" @selected($value === ($dealConstraint->vulnerable_NS ?? ''))>
                                {{ $text }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Vulnerable WE:</strong>
                    <select class="form-control" name="vulnerable_WE">
                        @foreach ($DEAL_CONSTRAINTS_VULNERABLE as $value => $text)
                            <option value="{{ $value }}" @selected($value === ($dealConstraint->vulnerable_WE ?? ''))>
                                {{ $text }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Dealer:</strong>
                <select class="form-control" name="dealer">
                    @foreach ($DEAL_CONSTRAINTS_DEALER as $value => $text)
                        <option value="{{ $value }}" @selected($value === ($dealConstraint->dealer ?? ''))>
                            {{ $text }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>PC:</strong>
                <table class="table table-bordered">
                    <tr>
                        <th>Player</th>
                        <th>PC from (>=)</th>
                        <th>PC to (<=)</th>
                    </tr>
                    @for ($playerNo = 0; $playerNo < $PLAYERS_COUNT; ++$playerNo)
                        <tr>
                            <th>{{ $PLAYERS_NAMES[$playerNo] }}</th>
                            @foreach (['from', 'to'] as $suffix)
                                <td>
                                    @php
                                        $name = 'PC_' . $playerNo . '_' . $suffix;
                                    @endphp
                                    @include (
                                        'components.select-int',
                                        [
                                            'name' => $name,
                                            'value' => $dealConstraint->$name ?? $DEAL_CONSTRAINTS_FIELDS[$name]['defaultValue'],
                                            'defaultValue' => $DEAL_CONSTRAINTS_FIELDS[$name]['defaultValue'],
                                            'maxValue' => $DEAL_CONSTRAINTS_FIELDS[$name]['maxValue'],
                                            'edit' => 1,
                                        ]
                                    )
                                </td>
                            @endforeach
                        </tr>
                    @endfor
                </table>

                <table class="table table-bordered">
                    <tr>
                        <th>Pair</th>
                        <th>PC from (>=)</th>
                        <th>PC to (<=)</th>
                    </tr>
                    <tr>
                        <th>NS</th>
                            @foreach (['from', 'to'] as $suffix)
                                <td>
                                    @php
                                        $name = 'PC_02_' . $suffix;
                                    @endphp
                                    @include (
                                        'components.select-int',
                                        [
                                            'name' => $name,
                                            'value' => $dealConstraint->$name ?? $DEAL_CONSTRAINTS_FIELDS[$name]['defaultValue'],
                                            'defaultValue' => $DEAL_CONSTRAINTS_FIELDS[$name]['defaultValue'],
                                            'maxValue' => $DEAL_CONSTRAINTS_FIELDS[$name]['maxValue'],
                                            'edit' => 1,
                                        ]
                                    )
                                </td>
                            @endforeach
                    </tr>
                    <tr>
                        <th>WE</th>
                            @foreach (['from', 'to'] as $suffix)
                                <td>
                                    @php
                                        $name = 'PC_13_' . $suffix;
                                    @endphp
                                    @include (
                                        'components.select-int',
                                        [
                                            'name' => $name,
                                            'value' => $dealConstraint->$name ?? $DEAL_CONSTRAINTS_FIELDS[$name]['defaultValue'],
                                            'defaultValue' => $DEAL_CONSTRAINTS_FIELDS[$name]['defaultValue'],
                                            'maxValue' => $DEAL_CONSTRAINTS_FIELDS[$name]['maxValue'],
                                            'edit' => 1,
                                        ]
                                    )
                                </td>
                            @endforeach
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Number of cards in colors:</strong>
                <table class="table table-bordered">
                    <tr>
                        <th rowspan="2">Player</th>
                        @foreach ($COLORS_NAMES as $colorName)
                            <th colspan="2">{{ $colorName }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach ($COLORS_NAMES as $colorName)
                            <th>from (>=)</th>
                            <th>to (<=)</th>
                        @endforeach
                    </tr>
                    @for ($playerNo = 0; $playerNo < $PLAYERS_COUNT; ++$playerNo)
                        <tr>
                            <th>{{ $PLAYERS_NAMES[$playerNo] }}</th>
                            @foreach ($COLORS_NAMES as $colorName)
                                @foreach (['from', 'to'] as $suffix)
                                <td>
                                    @php
                                        $name = $colorName . '_' . $playerNo . '_' . $suffix;
                                    @endphp
                                    @include (
                                        'components.select-int',
                                        [
                                            'name' => $name,
                                            'value' => $dealConstraint->$name ?? $DEAL_CONSTRAINTS_FIELDS[$name]['defaultValue'],
                                            'defaultValue' => $DEAL_CONSTRAINTS_FIELDS[$name]['defaultValue'],
                                            'maxValue' => $DEAL_CONSTRAINTS_FIELDS[$name]['maxValue'],
                                            'edit' => 1,
                                        ]
                                    )
                                </td>
                                @endforeach
                            @endforeach
                        </tr>
                    @endfor
                </table>

            </div>
        </div>
@if ($formAction)
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
@endif
    </div>

@if (!$formAction)
    </fieldset>
@endif
</form>
