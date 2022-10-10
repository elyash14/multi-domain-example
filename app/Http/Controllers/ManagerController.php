<?php

namespace App\Http\Controllers;

use Exception;
use RenokiCo\LaravelK8s\LaravelK8sFacade as K8s;
use RenokiCo\PhpK8s\Exceptions\KubernetesAPIException;

class ManagerController extends Controller
{
    public function index($error = null)
    {
        try {
            $cluster = K8s::getCluster();

            $foo = $cluster->pod()->whereName('foo-app')->get();
            $bar = $cluster->pod()->whereName('bar-app')->get();

            $ingress = $cluster->ingress()->whereName('example-ingress')->get();

            return view('manager', [
                'error' => $error,
                'foo' => $foo,
                'bar' => $bar,
                'ingress' => $ingress,
            ]);
        } catch (KubernetesAPIException $exception) {
            return view('manager', [
                'error' => $exception->getMessage(),
                'foo' => null,
                'bar' => null,
                'ingress' => null,
            ]);
        } catch (Exception $exception) {
            return view('manager', [
                'error' => $exception->getMessage(),
                'foo' => null,
                'bar' => null,
                'ingress' => null,
            ]);
        }
    }

    public function create()
    {
        try {
            $this->deployApplication('/app/configs/foo-app.yaml');

            $this->deployApplication('/app/configs/bar-app.yaml');

            $this->applyIngress();

            return redirect(route('list-resource', ['error' => null]));

        } catch (Exception $exception) {
            return redirect(route('list-resource', ['error' => $exception->getMessage()]));
        }
    }

    public function delete()
    {
        try {
            $cluster = K8s::getCluster();

            // $cluster->pod()->whereName('foo-app')->get()->delete();
            // $cluster->service()->whereName('foo-service')->get()->delete();

            $cluster->pod()->whereName('bar-app')->get();
            $cluster->service()->whereName('bar-service')->get()->delete();

            $cluster->ingress()->whereName('example-ingress')->get()->delete();

            return redirect(route('list-resource'));

        } catch (Exception $exception) {
            return redirect(route('list-resource', ['error' => 'message']));
        }
    }

    ####

    private function deployApplication($filename)
    {
        $cluster = K8s::getCluster();
        $configs = $cluster->fromYamlFile(storage_path() . $filename);

        foreach ($configs as $config) {
            $config->createOrUpdate();
            echo "{$config->getName()} synced! <br/>";
        }
    }

    private function applyIngress()
    {
        $cluster = K8s::getCluster();
        $config = $cluster->fromYamlFile(storage_path() . '/configs/ingress.yaml');

        $config->createOrUpdate();
        echo "{$config->getName()} synced! <br/>";
    }
}
