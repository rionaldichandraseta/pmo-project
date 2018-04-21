<?php

namespace Tests\Browser;

use App\Kinerja;
use App\Pegawai;
use App\PMO;
use App\User;
use function PHPSTORM_META\type;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserAsPMOTest extends DuskTestCase
{
    private $user;

    protected function setUp()
    {
        parent::setUp();
        $pmo = PMO::inRandomOrder();
        if (is_null($pmo)) {
            factory(User::class)->create();
            $pmo = factory(PMO::class)->create();
        } else {
            $pmo = $pmo->first();
        }
        $this->user = User::find($pmo->id_user);
    }


    public function testPMOLogin()
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('email', $this->user->email)
                    ->type('password', 'password')
                    ->press('Login')
                    ->assertPathIs('/pages');
        });
    }

    public function testPMOPage() {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                    ->visit('/pages/pmo')
                    ->assertSee('UPT PMO')
                    ->assertSeeIn('@pmo-navbar', 'Data Pegawai')
                    ->assertSeeIn('@pmo-navbar', 'Data Kompetensi')
                    ->assertSeeIn('@pmo-navbar', 'Data Kinerja')
                    ->assertVue('currentTab', 'dataPegawai', '@pmo-main-page')
                    ->assertMissing('@tambah-data-button')
                    ->assertMissing('@upload-data-button')
                    ->assertVisible('@download-data-button')
                    ->assertVisible('@data-table')
                    ->assertVue('tableTitle', 'Data Pegawai', '@data-table');
        });
    }

    public function testPageNavigation() {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                    ->visit('/pages/pmo')
                    ->click('#dataKompetensi')
                    ->assertVue('currentTab', 'dataKompetensi', '@pmo-main-page')
                    ->assertVisible('@tambah-data-button')
                    ->assertVisible('@upload-data-button')
                    ->assertVisible('@download-data-button')
                    ->assertVisible('@data-table')
                    ->assertVue('tableTitle', 'Data Kompetensi', '@data-table')
                    ->click('#dataKinerja')
                    ->assertVue('currentTab', 'dataKinerja', '@pmo-main-page')
                    ->assertVisible('@tambah-data-button')
                    ->assertVisible('@upload-data-button')
                    ->assertVisible('@download-data-button')
                    ->assertVisible('@data-table')
                    ->assertVue('tableTitle', 'Data Kinerja', '@data-table')
                    ->click('#dataPegawai')
                    ->assertVue('currentTab', 'dataPegawai', '@pmo-main-page')
                    ->assertMissing('@tambah-data-button')
                    ->assertMissing('@upload-data-button')
                    ->assertVisible('@download-data-button')
                    ->assertVisible('@data-table')
                    ->assertVue('tableTitle', 'Data Pegawai', '@data-table');
        });
    }

    public function testAddDataKinerja() {
        $nip = Pegawai::inRandomOrder()->first()->nip;

        $initialDataCount = Kinerja::all()->count();

        $this->browse(function (Browser $browser) use ($nip) {
            $browser->loginAs($this->user)
                    ->visit('/pages/pmo')
                    ->click('#dataKinerja')
                    ->click('@tambah-data-button')
                    ->whenAvailable('.modal', function ($modal) use ($nip) {
                        $modal->type('#nip', $nip)
                            ->type('#tahun', random_int(1945, 2018))
                            ->type('#semester', random_int(1, 2))
                            ->type('#nilai', random_int(1, 6))
                            ->type('#catatan', str_random(30))
                            ->press('Simpan')
                            ->waitFor('.alert')
                            ->press('Batal');
                    })
                    ->waitUntilMissing('#addDataModal');
        });

        $finalDataCount = Kinerja::all()->count();
        self::assertTrue($finalDataCount == $initialDataCount+1);
    }
}
