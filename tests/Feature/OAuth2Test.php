<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Laravel\Passport\Passport;
use Tests\TestCase;

class OAuth2Test extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_oauthLogin() {

        $body = [
            'username' => self::USER_TEST_USERNAME,
            'password' => self::USER_TEST_PASSWORD,
            'client_id' => self::PASSPORT_CLIENT_ID,
            'client_secret' => self::PASSPORT_CLIENT_SECRET,
            'grant_type' => 'password',
            'scope' => ''
        ];
        $this->json('POST','/oauth/token',$body,['Accept' => 'application/json'])
            ->assertStatus(self::HTTP_OK)
            ->assertJsonStructure(['token_type','expires_in','access_token','refresh_token']);
    }

    public function test_oauthLoginWithWrongClient() {

        $body = [
            'username' => self::USER_TEST_USERNAME,
            'password' => self::USER_TEST_PASSWORD,
            'client_id' => self::PASSPORT_CLIENT_ID . 'test',
            'client_secret' => self::PASSPORT_CLIENT_SECRET . 'test',
            'grant_type' => 'password',
            'scope' => ''
        ];
        $this->json('POST','/oauth/token',$body,['Accept' => 'application/json'])
            ->assertStatus(self::HTTP_UNAUTHORIZED);
    }

    public function test_unauthenticated()
    {
        $response = $this->withHeaders([
                'Authorization' => 'Bearer not_token',
                'Accept' => 'application/json',
            ])->get('/api/user');

        $response->assertStatus(self::HTTP_UNAUTHORIZED);
    }

    public function test_onlyAuthenticatedUserCanGetInfoSuccessfully()
    {
        $user = User::first();
        Passport::actingAs($user);

        $response = $this->get('/api/user');

        $response->assertStatus(self::HTTP_OK);
    }


    public function test_importFileWrongScope(){

        $user = User::first();
        Passport::actingAs($user, ['not_import']);

        $response = $this->postJson('/api/import', [
            'import_file' => UploadedFile::fake()->image('avatar.jpg')
        ]);

        $response->assertStatus(self::HTTP_FORBIDDEN);
    }

    public function test_importWithWrongFileImage(){

        $user = User::first();
        Passport::actingAs($user, ['import']);

        $response = $this->postJson('/api/import', [
            'import_file' => UploadedFile::fake()->image('avatar.jpg')
        ]);

        $response->assertStatus(self::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure(['message','errors']);
    }

    public function test_importWithWrongFilePhp(){

        $user = User::first();
        Passport::actingAs($user, ['import']);

        $response = $this->postJson('/api/import', [
            'import_file' => UploadedFile::fake()->create('file.php')
        ]);

        $response->assertStatus(self::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_importExcel(){

        $user = User::first();
        Passport::actingAs($user, ['import']);

        $response = $this->postJson('/api/import', [
            'import_file' => new UploadedFile(__DIR__ . '\file_import\import.xlsx','import_test.xlsx', 'application/vnd.ms-excel', null, true),
        ]);

        $response->assertStatus(self::HTTP_OK);
    }

    public function test_importCsv(){

        $user = User::first();
        Passport::actingAs($user, ['import']);

        $response = $this->postJson('/api/import', [
            'import_file' => new UploadedFile(__DIR__ . '\file_import\import.csv','import_test.csv', 'text/plain', null, true),
        ]);

        $response->assertStatus(self::HTTP_OK);
    }

    public function test_importWrongDate(){

        $user = User::first();
        Passport::actingAs($user, ['import']);

        $response = $this->postJson('/api/import', [
            'import_file' => new UploadedFile(__DIR__ . '\file_import\import_wrong_date.xlsx','import_test.xlsx', 'application/vnd.ms-excel', null, true),
        ]);

        $response->assertStatus(self::HTTP_OK)
            ->assertJsonStructure(['error']);
    }

}
