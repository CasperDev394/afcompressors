<?php

namespace App\Http\Controllers;

use App\Models\Compressor;
use App\Models\CompressorModel;
use App\Models\Option;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\View\View;

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
        return view('home');
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
        // TODO: implement general contacts form submission.
        return response()->json(['status' => 'todo'], 202);
    }

    public function submitQuoteRequest(Request $request): JsonResponse
    {
        // TODO: implement quote request form submission.
        return response()->json(['status' => 'todo'], 202);
    }

    protected function abortIfOptionUnavailable(Option $option): void
    {
        if (!$option->published) {
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
            '8-10-bar' => [
                'meta_title' => '8 и 10 бар',
            ],
        ];

        if (!isset($categories[$category])) {
            throw new NotFoundHttpException();
        }

        return $categories[$category];
    }
}
