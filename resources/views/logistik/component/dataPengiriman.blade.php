@for ($i = 0; $i < sizeof($dataAll); $i++)
<div class="row">
@for ($j = 1; $j <= 3; $j++)
    <div class="col">
        <div class="card">
            <p>{{$dataAll[$i]->kode_pengiriman}}</p>
        </div>
    </div>
    @if ($i == sizeof($dataAll) - 1)
        <?php break ?>
    @endif
    @if ($j != 3)
        <?php $i++ ?>
    @endif
@endfor
</div>
@endfor