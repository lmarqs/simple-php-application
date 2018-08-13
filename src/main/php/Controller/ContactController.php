<?php
namespace lmarqs\Spa\Controller;

use lmarqs\Spa\Middleware\Request;
use lmarqs\Spa\Model\Contact;
use lmarqs\Spa\Service\ContactService;

class ContactController extends Controller
{

    public static function processRequest($request, $response)
    {
        $id = $request->getAttribute('id');
        if ($id != null) {
            if ($request->method() == Request::METHOD_GET) {
                if ($id) {
                    $service = new ContactService();
                    $request->addAttributes($service->fetch($id));
                }

                self::render('contact/form', $request, $response);
                return;
            }

            try {
                self::processModel($id, $request);
                $response->setHeader('Location', '/contact')->send();
            } catch (ValidationException $ex) {
                $response->addErrors($ex->getErrors());
                self::render('contact/form', $request, $response);
            }

        } else {
            self::render('contact/list', $request, $response);
        }
    }

    private static function processModel($id, $request)
    {

        $parameters = $request->parameters();

        $model = new Contact();
        $model->fromArray($parameters);

        $service = new ContactService();

        if ($id) {
            $service->update($model);
        } else {
            $service->insert($model);
        }
    }
}
