@if ($document->lastPage() > 1)
    <?php
    $params = null;
    foreach ($_GET as $key => $param) {
        if ($key != 'page') {
            $params[] = $key . '=' . $param;
        }
    }
    if (isset($params)) {
        $params = implode('&', $params);
        $symbol = '&';
    } else {
        $symbol = '?';

    }

    if (isset($params)) {
        $url = $url .'?'. $params;
    }
    ?>
    <ul class="pagination">
        <li class="{{ ($document->currentPage() == 1) ? ' disabled' : '' }}">
            <?php


            if ($document->currentPage() == 1) {
                $previousPage = 1;
            } else {
                $previousPage = $document->currentPage() - 1;
            }?>

            <a href="{{url($url.$symbol.'page='.$previousPage) }}"
               onclick="{{ ($document->currentPage() == 1) ? "return false;" : 'return true' }}"
            >Previous</a>
        </li>
        @for ($i = 1; $i <= $document->lastPage(); $i++)

            <li class="{{ ($document->currentPage() == $i) ? ' active' : '' }}">

                <a href="{{ url($url.$symbol.'page='.$i) }}">{{ $i }}</a>
            </li>
        @endfor

        <li class="{{ ($document->currentPage() == $document->lastPage()) ? 'disabled' : '' }}">
            <?php $nextPage = $document->currentPage() + 1;?>
            <a href="{{ url($url.$symbol.'page='.$nextPage) }}"

               onclick="{{ ($document->currentPage() == $document->lastPage()) ? "return false;" : 'return true' }}">Next</a>
        </li>
    </ul>
@endif