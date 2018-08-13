<?php
namespace lmarqs\Spa\Persistence;

use lmarqs\Spa\Model\Contact;

class ContactDao extends Dao
{

    protected function table()
    {
        return 'contact';
    }

    protected function model()
    {
        return new Contact();
    }
}
