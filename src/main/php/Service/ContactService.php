<?php
namespace lmarqs\Spa\Service;

use lmarqs\Spa\Persistence\ContactDao;

use Elasticsearch\ClientBuilder;

class ContactService extends Service
{
    public function getDao()
    {
        return new ContactDao();
    }

    public function validate($model)
    {

        $errors = [];

        if (empty(trim($model->getName()))) {
            $errors['name'] = 'Name can not be empty';
        }

        if (strlen($model->getName()) > 128) {
            $errors['name'] = 'Name too long';
        }

        if (!empty($model->getEmail()) && !filter_var($model->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email';
        }

        $birthday = explode('-', $model->getBirthday());
        // checkdate(month,day,year);
        if (!checkdate($birthday[1], $birthday[2], $birthday[0])) {
            $errors['birthday'] = 'Invalid birthday';
        }

        if (!empty($errors)) {
            $ex = new ValidationException();
            $ex->setErrors($errors);
            throw $ex;
        }
    }
}
