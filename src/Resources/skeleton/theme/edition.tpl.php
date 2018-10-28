
{% use 'flash.html.twig' %}

<div class="container">

    {{ form_start(form) }}

    <div class="jumbotron jumbotron-fluid jumbotron-cv buttons-group-edition-container">
        <div class="container">
            <h1>{{ cv.user.fullName }}</h1>
            <h2>{{ cv.nom }}</h2>
            <div class="buttons-group-edition">
                <button type="button" class="btn btn-primary btn-round" data-toggle="modal" data-target="#modal-nom">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>

    {{ block('flash') }}

    {{ form_errors(form) }}

    <div class="row">
        <div class="col-3">
            <div class="card buttons-group-edition-container">
                <div class="card-body">
                    <div class="buttons-group-edition">
                        <button type="button" class="btn btn-primary btn-round" data-toggle="modal" data-target="#modal-generale">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                    </div>
                    <img class="mx-auto d-block img-fluid" src="{{ cv_avatar(cv) }}" alt="Generic placeholder image" />
                </div>
            </div>
            <div class="card buttons-group-edition-container">
                <div class="card-body">
                    <h5 class="card-title">Contacts</h5>
                    <div class="buttons-group-edition">
                        <button type="button" class="btn btn-primary btn-round" data-toggle="modal" data-target="#modal-contacts">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="row">
                        {% for contact in cv.contacts %}
                        <div class="col">
                            <div class="text-center" data-container="body" data-toggle="popover" data-content="{{ contact.valeur }}">
                                <i class="{{ contact | contact_icon_class }} fa-fw" aria-hidden="true"></i>
                            </div>
                        </div>
                        {% endfor %}
                    </div>
                </div>
            </div>
            <div class="card buttons-group-edition-container">
                <div class="card-body">
                    <h5 class="card-title">Situation professionnelle</h5>
                    <div class="buttons-group-edition">
                        <button type="button" class="btn btn-primary btn-round" data-toggle="modal" data-target="#modal-disponibilite">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                    </div>
                    <dl>
                        <dd>{{ cv.situationProfessionnelle | readable_enum }}</dd>
                        <dd>{{ cv.disponibilite | readable_enum }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-6">
            <h1>
                <i class="fa fa-briefcase" aria-hidden="true"></i>
                Experiences
            </h1>
            {% for experience in cv.experiences %}
            <div class="card buttons-group-edition-container">
                <div class="card-body">
                    <div class="buttons-group-edition">
                        <button type="button" class="btn btn-primary btn-round" data-toggle="modal" data-target="#modal-experience-{{ experience.id }}">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                        <button type="button"
                                class="btn btn-primary btn-round"
                                data-remove="#modal-experience-{{ experience.id }}"
                                data-remove-title="Attention"
                                data-remove-body="Êtes-vous sur de vouloir supprimer cette expérience ?">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </div>
                    <h2 class="card-title">{{ experience.informationsGenerales.intitulePoste }}</h2>
                    <h3>{{ experience.entreprise.nom }}</h3>
                    <div>{{ experience_periode(experience) }}</div>
                    <div>
                            <span class="badge badge-secondary">
                                {{ experience.typeContrat | readable_enum  }}
                            </span>
                        <span class="badge badge-secondary">
                                {{ experience.ville.nom  }}
                            </span>
                    </div>
                </div>
            </div>
            {% endfor %}
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-experience-new">Ajouter</button>
        </div>
        <div class="col-3">
            <h1>
                <i class="fa fa-id-card-o" aria-hidden="true"></i>
                Compétences
            </h1>
            {% for domaineCompetence in cv.domainesCompetence %}
            <div class="card buttons-group-edition-container">
                <div class="card-body">
                    <div class="buttons-group-edition">
                        <button type="button" class="btn btn-primary btn-round" data-toggle="modal" data-target="#modal-domaine-{{ domaineCompetence.id }}">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                        <button type="button"
                                class="btn btn-primary btn-round"
                                data-remove="#modal-domaine-{{ domaineCompetence.id }}"
                                data-remove-title="Attention"
                                data-remove-body="Êtes-vous sur de vouloir supprimer ce domaine de compétence ?">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </div>
                    <h2 class="card-title">{{ domaineCompetence.nom }}</h2>
                    <ul>
                        {% for competence in domaineCompetence.competences %}
                        <li>
                            {{ competence.nom }}
                            {{ competence.note }}
                        </li>
                        {% endfor %}
                    </ul>
                </div>
            </div>
            {% endfor %}
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-domaine-new">Ajouter</button>
        </div>
    </div>

    <div class="modal" id="modal-nom" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">informations générales</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ include(cv.theme.getTemplatePath() ~ '/subform/formulaire-nom.html.twig', { 'form': form }) }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modal-generale" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">informations générales</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ include(cv.theme.getTemplatePath() ~ '/subform/formulaire-generale.html.twig', { 'form': form }) }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modal-contacts" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ include(cv.theme.getTemplatePath() ~ '/subform/formulaire-contacts.html.twig', { 'form': form }) }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modal-disponibilite" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Situation professionnelle & disponibilité</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ include(cv.theme.getTemplatePath() ~ '/subform/formulaire-disponibilite.html.twig', { 'form': form }) }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
    <div data-container="experience">
        {% for experienceField in form.experiences %}
        <div class="modal" id="modal-experience-{{ experienceField.vars.value.id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier l'expérience</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ include(cv.theme.getTemplatePath() ~ '/subform/formulaire-experience.html.twig', { 'form': experienceField }) }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>
        {% endfor %}
    </div>

    <div class="modal" id="modal-experience-new" tabindex="-1" role="dialog" data-type-container="experience" data-prototype="{{ include(cv.theme.getTemplatePath() ~ '/subform/formulaire-experience.html.twig', { 'form': form.experiences.vars.prototype }) | e}}">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une nouvelle expérience</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>

    <div data-container="domaine">
        {% for domaineField in form.domainesCompetence %}
        <div class="modal" id="modal-domaine-{{ domaineField.vars.value.id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier le domaine de compétence</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ include(cv.theme.getTemplatePath() ~ '/subform/formulaire-domaine.html.twig', { 'form': domaineField }) }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>
        {% endfor %}
    </div>

    <div class="modal" id="modal-domaine-new" tabindex="-1" role="dialog" data-type-container="domaine" data-prototype="{{ include(cv.theme.getTemplatePath() ~ '/subform/formulaire-domaine.html.twig', { 'form': form.domainesCompetence.vars.prototype }) | e}}">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un nouveau domaine de compétence</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-remove" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" data-remove-confirmed>Confirmer</button>
                </div>
            </div>
        </div>
    </div>

    {{ form_end(form) }}

</div>
