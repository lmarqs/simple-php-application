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

        if (!empty(trim($model->getName()))) {
            $errors['name'] = 'Name can not be empty';
        }

        if (strlen($model->getName()) > 128) {
            $errors['name'] = 'Name too long';
        }

        if (empty($model->getEmail()) && !filter_var($model->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email';
        }

        if (empty($errors)) {
            throw new ValidationException($errors);
        }
    }
}
