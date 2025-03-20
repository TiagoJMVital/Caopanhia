<?php


namespace frontend\tests\Acceptance;

use common\models\Distritos;
use common\models\User;
use common\models\Userprofile;
use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class ViewProfileCest
{

    public function _after(AcceptanceTester $I)
    {
        //Delete user
        $userProfile = Userprofile::find()->one();
        if ($userProfile != null)
            $userProfile->delete();
        $user = User::find()->one();
        if ($user != null)
            $user->delete();

    }

    // tests
    public function ViewUserProfileTest(AcceptanceTester $I)
    {
        //Aceder ao sistema
        $I->amOnPage(Url::toRoute('/site/login'));
        $I->see('Login');
        //Criar conta no sistema
        $I->click('Crie agora');
        $I->see('Sign Up');

        $I->fillField('Username', 'user');
        $I->fillField('Email', 'email@mail.pt');
        $I->fillField('Password', 'userPassword');
        $I->fillField('Nome', 'nomeUser');
        $I->fillField('Morada', 'moradaUser');
        $I->fillField('Codigo Postal', '1234-123');
        $I->fillField('Nif', '123456789');
        $I->fillField('Contacto', '987654321');

        $I->scrollTo('#signup-button');
        $I->wait(2);
        $I->click('button[type=submit]');

        $I->wait(2);

        //Fazer login com a conta criada
        $I->see('Login');
        $I->fillField('Username', 'user');
        $I->fillField('Password', 'userPassword');
        $I->click('#login-button');

        $I->wait(2);

        //Verificar que o utilizador entrou no sistema
        $I->see('CÃOPANHIA');
        $I->see('O teu melhor amigo');

        //Aceder aos dados do utilizador
        $I->click('.navbar-toggler');
        $I->wait(1);
        $I->click('Perfil');

        $I->wait(3);

        //Verificar os dados do utilizador
        $I->see('Informação Pessoal');
        $I->see('user');
        $I->see('Email');
        $I->see('email@mail.pt');
        $I->see('Contacto');
        $I->see('987654321');
        $I->see('Genero');
        $I->see('Masculino');
        $I->see('NIF');
        $I->see('123456789');
        $I->see('Morada');
        $I->see('moradaUser');
        $I->see('Codigo Postal');
        $I->see('1234-123');
        $I->see('Distrito');
        $I->see('Alterar dados');
    }
}
