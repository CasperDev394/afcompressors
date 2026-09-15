<?php

namespace App\Http\Controllers;

use App\Mail\WebsiteFormSubmitted;
use App\Models\Compressor;
use App\Models\CompressorModel;
use App\Models\News;
use App\Models\Option;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class HomeController extends Controller
{
//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function getBlade(): View
    {
        $settings = SiteSetting::current();

        return view('home', [
            'siteSettings' => $settings,
            'title' => $settings->home_title,
            'description' => $settings->home_description,
        ]);
    }

    public function getContactBlade(): View
    {
        return view('contact');
    }

    public function getOptionsBlade(): View
    {
        return view('options', [
            'title' => 'Опции | AF compressors',
            'description' => 'Опции AF compressors',
        ]);
    }

    public function getAfTechnologyBlade(): View
    {
        return view('af-technology', [
            'title' => 'Технология AF | AF compressors',
            'description' => 'Технология AF compressors',
        ]);
    }

    public function getOurCompanyBlade(): View
    {
        return view('our-company', [
            'title' => 'Наша компания | AF compressors',
            'description' => 'Наша компания AF compressors',
        ]);
    }

    public function getSustainabilityBlade(): View
    {
        return view('sustainability', [
            'title' => 'Устойчивое развитие | AF compressors',
            'description' => 'Устойчивое развитие AF compressors',
        ]);
    }

    public function getServicesBlade(): View
    {
        return view('services', [
            'title' => 'Услуги | AF compressors',
            'description' => 'Услуги AF compressors',
        ]);
    }

    public function getSparePartsBlade(): View
    {
        return view('spare-parts', [
            'title' => 'Продажа запчастей | AF compressors',
            'description' => 'Продажа запчастей AF compressors',
        ]);
    }

    public function getNewsBlade(): View
    {
        return view('news', [
            'title' => 'Новости | AF compressors',
            'description' => 'Новости AF compressors',
        ]);
    }

    public function readNews(): JsonResponse
    {
        $items = News::query()
            ->where('published', true)
            ->with('attachments')
            ->orderByDesc('id')
            ->get();

        return response()->json([
            'data' => $items->map(function (News $news) {
                $image = $news->attachments->first();

                return [
                    'id' => $news->id,
                    'name' => $news->name,
                    'name_slug' => $news->name_slug,
                    'href' => '/news/' . $news->name_slug,
                    'image' => $image ? [
                        'id' => $image->id,
                        'url' => $image->url,
                        'title' => $image->title,
                    ] : null,
                ];
            })->values(),
        ]);
    }

    public function getNewsItemBlade(News $news): View
    {
        $this->abortIfNewsUnavailable($news);

        return view('news-item', [
            'title' => $news->name . ' | AF compressors',
            'description' => $news->name,
            'news' => $news,
        ]);
    }

    public function readNewsItem(News $news): JsonResponse
    {
        $this->abortIfNewsUnavailable($news);

        $news->load('attachments');

        return response()->json([
            'data' => [
                'id' => $news->id,
                'name' => $news->name,
                'name_slug' => $news->name_slug,
                'description' => $news->description,
                'images' => $news->attachments->map(function ($attachment) {
                    return [
                        'id' => $attachment->id,
                        'url' => $attachment->url,
                        'title' => $attachment->title,
                    ];
                })->values(),
            ],
        ]);
    }

    public function getSolutionsBlade(): View
    {
        return view('solutions', [
            'title' => 'Безмасляные поршневые компрессоры | AF compressors',
            'description' => 'Безмасляные поршневые компрессоры AF compressors',
        ]);
    }

    public function getSolutionsCategoryBlade(string $category): View
    {
        $config = $this->getSolutionsCategoryConfig($category);

        return view('solutions-category', [
            'title' => $config['meta_title'] . ' | AF compressors',
            'description' => $config['meta_title'],
            'category' => $category,
        ]);
    }

    public function readSolutionsCategory(string $category): JsonResponse
    {
        $this->getSolutionsCategoryConfig($category);

        $compressors = Compressor::query()
            ->where('published', true)
            ->where('pressure_category', $category)
            ->with('attachments')
            ->orderBy('name')
            ->get();

        return response()->json([
            'data' => [
                'compressors' => $compressors->map(function (Compressor $compressor) use ($category) {
                    $image = $compressor->attachments->first();

                    return [
                        'id' => $compressor->id,
                        'name' => $compressor->name,
                        'name_slug' => $compressor->name_slug,
                        'href' => '/solutions/' . $category . '/' . $compressor->name_slug,
                        'image' => $image ? [
                            'id' => $image->id,
                            'url' => $image->url,
                            'title' => $image->title,
                        ] : null,
                    ];
                })->values(),
            ],
        ]);
    }

    public function getSolutionsCompressorBlade(string $category, Compressor $compressor): View
    {
        $config = $this->getSolutionsCategoryConfig($category);
        $this->abortIfCompressorUnavailable($compressor, $category);

        return view('solutions-compressor', [
            'title' => $compressor->name . ' | AF compressors',
            'description' => $config['meta_title'] . ' ' . $compressor->name,
            'category' => $category,
            'compressor' => $compressor,
        ]);
    }

    public function readSolutionsCompressor(string $category, Compressor $compressor): JsonResponse
    {
        $this->getSolutionsCategoryConfig($category);
        $this->abortIfCompressorUnavailable($compressor, $category);

        $compressor->load(['attachments', 'models']);

        $image = $compressor->attachments->first();

        $options = Option::query()
            ->where('published', true)
            ->orderBy('name')
            ->with('iconAttachment')
            ->get();

        return response()->json([
            'data' => [
                'compressor' => [
                    'id' => $compressor->id,
                    'name' => $compressor->name,
                    'name_slug' => $compressor->name_slug,
                    'msf' => $compressor->msf,
                    'capacities_iso' => $compressor->capacities_iso,
                    'image' => $image ? [
                        'id' => $image->id,
                        'url' => $image->url,
                        'title' => $image->title,
                    ] : null,
                ],
                'models' => $compressor->models->map(function (CompressorModel $model) {
                    return [
                        'id' => $model->id,
                        'name' => $model->name,
                        'capacity' => $model->capacity !== null ? (float) $model->capacity : null,
                        'FAD' => $model->FAD,
                        'CFM' => $model->CFM,
                        'installed_power' => $model->installed_power,
                    ];
                })->values(),
                'options' => $options->map(function (Option $option) {
                    return [
                        'id' => $option->id,
                        'name' => $option->name,
                        'name_slug' => $option->name_slug,
                        'eco' => (bool) $option->eco,
                        'icon_attachment' => $option->iconAttachment ? [
                            'id' => $option->iconAttachment->id,
                            'url' => $option->iconAttachment->url,
                            'title' => $option->iconAttachment->title,
                        ] : null,
                    ];
                })->values(),
            ],
        ]);
    }

    public function getOptionBlade(Option $option): View
    {
        $this->abortIfOptionUnavailable($option);

        return view('option', [
            'title' => $option->name . ' | AF compressors',
            'description' => $option->name,
            'option' => $option,
        ]);
    }

    public function readOptions(): JsonResponse
    {
        $options = Option::query()
            ->where('published', true)
            ->orderBy('name')
            ->with('iconAttachment')
            ->get();

        return response()->json([
            'data' => $options->map(function (Option $option) {
                return [
                    'id' => $option->id,
                    'name' => $option->name,
                    'name_slug' => $option->name_slug,
                    'eco' => (bool) $option->eco,
                    'icon_attachment' => $option->iconAttachment ? [
                        'id' => $option->iconAttachment->id,
                        'url' => $option->iconAttachment->url,
                        'title' => $option->iconAttachment->title,
                    ] : null,
                ];
            })->values(),
        ]);
    }

    public function readOption(Option $option): JsonResponse
    {
        $this->abortIfOptionUnavailable($option);

        $option->load([
            'iconAttachment',
            'posts' => fn ($query) => $query->where('published', true)->orderBy('id'),
            'posts.attachments',
        ]);

        return response()->json([
            'data' => [
                'id' => $option->id,
                'name' => $option->name,
                'name_slug' => $option->name_slug,
                'icon_attachment' => $option->iconAttachment ? [
                    'id' => $option->iconAttachment->id,
                    'url' => $option->iconAttachment->url,
                    'title' => $option->iconAttachment->title,
                ] : null,
                'posts' => $option->posts->map(function ($post) {
                    return [
                        'id' => $post->id,
                        'name' => $post->name,
                        'description' => $post->description,
                        'image' => optional($post->attachments->first(), function ($attachment) {
                            return [
                                'id' => $attachment->id,
                                'url' => $attachment->url,
                                'title' => $attachment->title,
                            ];
                        }),
                    ];
                })->values(),
            ],
        ]);
    }

    public function submitGeneralContact(Request $request): JsonResponse
    {
        return $this->submitContactForm($request, 'general');
    }

    public function submitQuoteRequest(Request $request): JsonResponse
    {
        return $this->submitContactForm($request, 'quote');
    }

    public function submitNewsletter(Request $request): JsonResponse
    {
        $submission = $request->validate([
            'email' => ['required', 'email:rfc', 'max:255'],
            'consent' => ['accepted'],
        ]);

        return $this->sendWebsiteForm('newsletter', $submission);
    }

    protected function submitContactForm(Request $request, string $formType): JsonResponse
    {
        $rules = [
            'lastName' => ['required', 'string', 'max:100'],
            'firstName' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email:rfc', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'companyName' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
            'consent' => ['accepted'],
        ];

        if ($formType === 'quote') {
            $rules['country'] = ['required', 'string', 'max:100'];
            $rules['productType'] = ['required', 'string', 'in:Высокое давление,Низкое давление,Прочее'];
        }

        return $this->sendWebsiteForm($formType, $request->validate($rules));
    }

    protected function sendWebsiteForm(string $formType, array $submission): JsonResponse
    {
        if (app()->isProduction() && in_array(config('mail.default'), ['log', 'array'], true)) {
            return response()->json([
                'message' => 'Отправка сообщений временно недоступна. Пожалуйста, попробуйте ещё раз позже.',
            ], 503);
        }

        try {
            Mail::to(config('mail.website_forms_recipient'))->send(
                new WebsiteFormSubmitted($formType, $submission)
            );
        } catch (Throwable $exception) {
            report($exception);

            return response()->json([
                'message' => 'Не удалось отправить сообщение. Пожалуйста, попробуйте ещё раз позже.',
            ], 503);
        }

        return response()->json([
            'message' => 'Спасибо! Ваше сообщение успешно отправлено.',
        ]);
    }

    protected function abortIfOptionUnavailable(Option $option): void
    {
        if (!$option->published) {
            throw new NotFoundHttpException();
        }
    }

    protected function abortIfNewsUnavailable(News $news): void
    {
        if (!$news->published) {
            throw new NotFoundHttpException();
        }
    }

    protected function abortIfCompressorUnavailable(Compressor $compressor, string $category): void
    {
        if (!$compressor->published || $compressor->pressure_category !== $category) {
            throw new NotFoundHttpException();
        }
    }

    protected function getSolutionsCategoryConfig(string $category): array
    {
        $categories = [
            '15-40-bar' => [
                'meta_title' => '15 – 40 бар',
            ],
//            '8-10-bar' => [
//                'meta_title' => '8 и 10 бар',
//            ],
        ];

        if (!isset($categories[$category])) {
            throw new NotFoundHttpException();
        }

        return $categories[$category];
    }
}
