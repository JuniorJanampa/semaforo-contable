@props([
    'percentage'
])

<div class="card h-100">

    <div class="card-header">

        Progreso del Expediente

    </div>

    <div class="card-body">

        <div class="progress mb-3" style="height:10px;">

            <div
                class="progress-bar bg-success"
                role="progressbar"
                style="width: {{ $percentage }}%;"
            >

            </div>

        </div>

        <div class="d-flex justify-content-between">

            <span>

                Avance

            </span>

            <strong>

                {{ $percentage }}%

            </strong>

        </div>

    </div>

</div>