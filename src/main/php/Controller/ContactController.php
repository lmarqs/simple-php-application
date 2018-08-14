<?php
namespace lmarqs\Spa\Controller;

use lmarqs\Spa\Middleware\Request;
use lmarqs\Spa\Model\Contact;
use lmarqs\Spa\Service\ContactService;
use lmarqs\Spa\Service\ValidationException;

class ContactController extends Controller
{

    public static function processRequest($request, $response)
    {
        $id = $request->getAttribute('id');
        if ($id != null) {
            if ($request->method() == Request::METHOD_GET) {
                if ($id) {
                    $service = new ContactService();
                    $model = $service->fetch($id);
                    if ($model) {
                        $request->addAttributes($model->toArray());
                    }
                }

                self::render('contact/form', $request, $response);
                return;
            }

            try {
                self::processModel($id, $request);
                $response->setHeader('Location', '/contact')->send();
            } catch (ValidationException $ex) {
                $request->addAttributes($request->parameters());
                $request->addErrors($ex->getErrors());
                self::render('contact/form', $request, $response);
            }

        } else {
            self::render('contact/list', $request, $response);
        }
    }

    private static function processModel($id, $request)
    {

        $model = new Contact();
        $model->fromArray($request->parameters());
        
        $service = new ContactService();
        
        if ($id) {
            $model->setId($id);
            $service->update($model);
        } else {
            $service->insert($model);
        }
    }
}
