<?php

class chsFizikCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'chsFizik';
    public $classKey = 'chsFizik';
    public $languageTopics = array('chs');
    //public $permission = 'create';

    /**
     * @return bool
     */
    // Если нужно вывести переданные в процессор параметры, раскоментируй блок

    /*public function process() {

        print_r($this->getProperties());
        die();
    }*/

    public function beforeSet()
    {

        // добавляем загрузку файла
        if (!empty($_FILES['photo']['tmp_name'])) {
            $source = $this->modx->getObject('sources.modMediaSource', 1);
            $source->initialize();
            $file_dir = 'files/' . $_POST['uid'] . '/'; // Путь к файлу
            $dirs = explode('/', $file_dir);
            $path = $this->modx->getOption('base_path') . trim($this->modx->getOption('assets_url'), '/');
            foreach ($dirs as $dir) {
                $path = $path . '/' . trim($dir, '/');
                if (!file_exists($path)) {
                    mkdir($path);
                }
            }
            foreach ($_FILES as $key => $file) {
                $tmp = explode('.', $file['name']);
                $ext = array_pop($tmp);
                $filename = md5(time()) . '.' . $ext; // Имя файла
                $_FILES[$key]['name'] = $filename;
                $size = $_FILES[$key]['size'];
            }
            $this->setProperty('string1', str_replace($this->modx->getOption('base_path'), '/', $path) . $filename);
            if (!$source->uploadObjectsToContainer($this->modx->getOption('assets_url') . $file_dir, $_FILES)) {
                foreach ($source->errors as $error) {
                    $this->modx->lexicon->load('core:file');
                    $this->addFieldError('string1', $this->modx->lexicon($error, array(
                        'ext' => $ext,
                        'size' => $size,
                        'allowed' => $this->modx->getOption('upload_maxsize')
                    )));
                }
            }
        }
        // конец

        $this->setProperty('image', '/assets/' . $file_dir.$filename);

        $anonim = $this->getProperty('anonim');
        if ($anonim == 1) {
            $this->setProperty('uid', 0);
        }

        $show_autor = $this->getProperty('show_autor');
        if ($show_autor == '') {
            $this->setProperty('show_autor', 0);
        }

        $name = trim($this->getProperty('name'));
        if (empty($name)) {
            $this->modx->error->addField('name', $this->modx->lexicon('chs_fizik_err_name'));
        } elseif ($this->modx->getCount($this->classKey, array('name' => $name))) {
            $this->modx->error->addField('name', $this->modx->lexicon('chs_fizik_err_ae'));
        }

        return parent::beforeSet();
    }

}

return 'chsFizikCreateProcessor';