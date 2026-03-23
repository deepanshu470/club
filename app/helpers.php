<?php

function route_url(string $route, array $params = []): string
{
    $query = http_build_query(array_merge(['route' => $route], $params));
    return 'index.php?' . $query;
}

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
