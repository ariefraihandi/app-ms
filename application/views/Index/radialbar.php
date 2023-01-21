<!-- <?php
        $jum = '14';
        $ambil = '13';
        $sisa = $jum - $ambil;
        ?> -->
<style>
    @keyframes growProgressBar {

        0%,
        33% {
            --pgPercentage: 0;
        }

        5% {
            --pgPercentage: var(--value);
        }
    }

    @property --pgPercentage {
        syntax: '<decimal>';
        inherits: false;
        initial-value: 0;
    }

    div[role="progressbar"] {
        --size: 7rem;
        --fg: #696cff;
        --bg: #303283;
        --pgPercentage: var(--value);
        animation: growProgressBar 3s 1 forwards;
        width: var(--size);
        height: var(--size);
        border-radius: 50%;
        display: grid;
        place-items: center;
        background:
            radial-gradient(closest-side, white 80%, transparent 0 99.9%, white 0),
            conic-gradient(var(--fg) calc(var(--pgPercentage) * 1%), var(--bg) 0);
        font-family: Helvetica, Arial, sans-serif;
        font-size: calc(var(--size) / 10);
        color: var(--fg);
    }

    div[role="progressbar"]::before {
        counter-reset: percentage var(--value);
        content: '<?= $sisa; ?> Hari';
    }
</style>