<?php
use function Pest\Stressless\stress;

test('landing page', function(){
    $result = stress('http://127.0.0.1:8000');

    // Assert that requests were made
    expect($result->requests->count)->toBeGreaterThan(0);

    // Assert that no requests failed
    expect($result->requests->failed->count)->toBe(0);
});
