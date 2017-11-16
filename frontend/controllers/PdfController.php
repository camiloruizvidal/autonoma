
namespace  frontend\controllers;
use Yii;

use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\Anteproyecto;
use frontend\models\Jurado;
use frontend\models\FormSearch;
use frontend\models\DirectorProyecto;
use frontend\controllers\JuradoController;
use frontend\controllers\DirectorProyectoController;
use mPDF;

/**
 *
 */
class PdfController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [

                ],
                'rules' => [
                  [
                      'allow' => true,
                      'actions' => ['juradopdf', 'directorpdf', 'fechapdf'],
                      'roles' => [ 'Secretario'],
                  ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionJuradopdf() {

      $model = Jurado::find()->All(); //Consulta para buscar todos los registros
      $mPDF1 = new \Mpdf\Mpdf(); //Esto lo pueden configurar como quieren, para eso deben de entrar en la web de MPDF para ver todo lo que permite.
      $mPDF1->useOnlyCoreFonts = true;
      $mPDF1->SetTitle("Jurados - Reporte");
      $mPDF1->SetAuthor("Autonoma");
      $mPDF1->SetWatermarkText("Autonoma");
      $mPDF1->showWatermarkText = true;
      $mPDF1->watermark_font = 'DejaVuSansCondensed';
      $mPDF1->watermarkTextAlpha = 0.1;
      $mPDF1->SetDisplayMode('fullpage');
      $mPDF1->WriteHTML($this->renderPartial('pdfjurado', ['model'=>$model], true)); //hacemos un render partial a una vista preparada, en este caso es la vista pdfReport
      $mPDF1->Output('Reporte_Jurados'.date('YmdHis'),'I');  //Nombre del pdf y parámetro para ver pdf o descargarlo directamente.
      exit;

      }

      public function actionDirectorpdf() {

        $model = DirectorProyecto::find()->All(); //Consulta para buscar todos los registros
        $mPDF1 = new \Mpdf\Mpdf(); //Esto lo pueden configurar como quieren, para eso deben de entrar en la web de MPDF para ver todo lo que permite.
        $mPDF1->useOnlyCoreFonts = true;
        $mPDF1->SetTitle("Director de Grado - Reporte");
        $mPDF1->SetAuthor("Autonoma");
        $mPDF1->SetWatermarkText("Autonoma");
        $mPDF1->showWatermarkText = true;
        $mPDF1->watermark_font = 'DejaVuSansCondensed';
        $mPDF1->watermarkTextAlpha = 0.1;
        $mPDF1->SetDisplayMode('fullpage');
        $mPDF1->WriteHTML($this->renderPartial('pdfdirector',['model'=>$model], true)); //hacemos un render partial a una vista preparada, en este caso es la vista pdfReport
        $mPDF1->Output('Reporte_Jurados'.date('YmdHis'),'I');  //Nombre del pdf y parámetro para ver pdf o descargarlo directamente.
        exit;

        }
        public function actionFechapdf()
        {
           $model = Anteproyecto::find()->All();
           $mPDF1 = new \Mpdf\Mpdf(); //Esto lo pueden configurar como quieren, para eso deben de entrar en la web de MPDF para ver todo lo que permite.
           $mPDF1->useOnlyCoreFonts = true;
           $mPDF1->SetTitle("Director de Grado - Reporte");
           $mPDF1->SetAuthor("Autonoma");
           $mPDF1->SetWatermarkText("Autonoma");
           $mPDF1->showWatermarkText = true;
           $mPDF1->watermark_font = 'DejaVuSansCondensed';
           $mPDF1->watermarkTextAlpha = 0.1;
           $mPDF1->SetDisplayMode('fullpage');
           $mPDF1->WriteHTML($this->renderPartial('anteproyectopdf', ['model'=>$model], true)); //hacemos un render partial a una vista preparada, en este caso es la vista pdfReport
           $mPDF1->Output('Reporte_Jurados'.date('YmdHis'),'I');  //Nombre del pdf y parámetro para ver pdf o descargarlo directamente.
           exit;



        }
}
