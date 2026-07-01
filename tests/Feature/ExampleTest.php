// Dans tests/Feature/ExampleTest.php
public function test_the_application_returns_a_successful_response(): void
{
$response = $this->get('/');

// Remplacer 200 par 500 pour provoquer délibérément une anomalie
$response->assertStatus(500);
}
