<?php

namespace Shadowdactyl\Http\Controllers\Admin\Nests;

use Illuminate\View\View;
use Shadowdactyl\Models\Egg;
use Shadowdactyl\Models\EggVariable;
use Illuminate\Http\RedirectResponse;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Shadowdactyl\Http\Controllers\Controller;
use Shadowdactyl\Contracts\Repository\EggRepositoryInterface;
use Shadowdactyl\Services\Eggs\Variables\VariableUpdateService;
use Shadowdactyl\Http\Requests\Admin\Egg\EggVariableFormRequest;
use Shadowdactyl\Services\Eggs\Variables\VariableCreationService;
use Shadowdactyl\Contracts\Repository\EggVariableRepositoryInterface;

class EggVariableController extends Controller
{
    /**
     * EggVariableController constructor.
     */
    public function __construct(
        protected AlertsMessageBag $alert,
        protected VariableCreationService $creationService,
        protected VariableUpdateService $updateService,
        protected EggRepositoryInterface $repository,
        protected EggVariableRepositoryInterface $variableRepository,
        protected ViewFactory $view,
    ) {
    }

    /**
     * Handle request to view the variables attached to an Egg.
     *
     * @throws \Shadowdactyl\Exceptions\Repository\RecordNotFoundException
     */
    public function view(int $egg): View
    {
        $egg = $this->repository->getWithVariables($egg);

        return view('admin.eggs.variables', ['egg' => $egg]);
    }

    /**
     * Handle a request to create a new Egg variable.
     *
     * @throws \Shadowdactyl\Exceptions\Model\DataValidationException
     * @throws \Shadowdactyl\Exceptions\Service\Egg\Variable\BadValidationRuleException
     * @throws \Shadowdactyl\Exceptions\Service\Egg\Variable\ReservedVariableNameException
     */
    public function store(EggVariableFormRequest $request, Egg $egg): RedirectResponse
    {
        $this->creationService->handle($egg->id, $request->normalize());
        $this->alert->success(trans('admin/nests.variables.notices.variable_created'))->flash();

        return redirect()->route('admin.nests.egg.variables', $egg->id);
    }

    /**
     * Handle a request to update an existing Egg variable.
     *
     * @throws \Shadowdactyl\Exceptions\DisplayException
     * @throws \Shadowdactyl\Exceptions\Model\DataValidationException
     * @throws \Shadowdactyl\Exceptions\Repository\RecordNotFoundException
     * @throws \Shadowdactyl\Exceptions\Service\Egg\Variable\ReservedVariableNameException
     */
    public function update(EggVariableFormRequest $request, Egg $egg, EggVariable $variable): RedirectResponse
    {
        $this->updateService->handle($variable, $request->normalize());
        $this->alert->success(trans('admin/nests.variables.notices.variable_updated', [
            'variable' => htmlspecialchars($variable->name),
        ]))->flash();

        return redirect()->route('admin.nests.egg.variables', $egg->id);
    }

    /**
     * Handle a request to delete an existing Egg variable from the Panel.
     */
    public function destroy(int $egg, EggVariable $variable): RedirectResponse
    {
        $this->variableRepository->delete($variable->id);
        $this->alert->success(trans('admin/nests.variables.notices.variable_deleted', [
            'variable' => htmlspecialchars($variable->name),
        ]))->flash();

        return redirect()->route('admin.nests.egg.variables', $egg);
    }
}
