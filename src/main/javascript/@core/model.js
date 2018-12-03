/* eslint-disable max-lines-per-function, require-jsdoc */
/**
 * @module core/model
 */

const Backbone = require("backbone");

const model = Symbol("model");

/**
 * Validated decorator.
 * @function
 * @param {object} definition The model's definition.
 * @param {string} definition.validate The name of attribute that
 * identifies the model instance.
 * @param {string} [definition.cidPrefix=c] The prefix is used to create the
 * client id which is used to identify models locally.
 * You may want to override this if you're experiencing name clashes with model
 * ids.
 * @param {string} [definition.initialize] Define the initialization logic.
 * @returns {function} a function that mixes the class with a Backbone.Model
 * proxy.
 */

exports.Validated = function Validated (definition = {}) {
    return decorator;

    function decorator (target) {
        target.finisher = finisher;
    }

    /**
     * Mixes the class with a Backbone.Model proxy
     * @param {function} Class the target class
     * @return {Model} the mixed class
     */
    function finisher (Class) {
        return class extends Class {

            static getDefinition () {
                return definition;
            }

            /**
             * Create a point.
             * @param {number} attributes The x value.
             * @param {number} options The y value.
             */
            constructor (attributes, options) {
                super(attributes, options);
                const BackboneModel = new Backbone.Model.extends(definition);
                this[model] = new BackboneModel(attributes, options);
            }

            /**
             * The value returned during the last failed validation.
             * @type {any}
             */
            get validationError () {
                return this[model].validationError;
            }

            /**
             * Check if the model is currently in a valid state.
             * @param {object} options
             * * @param {object} [options.validate=true]
             * @return {boolean} `true` if the state is valid
             */
            isValid (options) {
                return this[model].isValid(options);
            }

        };
    }
};

/**
 * Model decorator.
 * @function
 * @param {object} definition The model's definition.
 * @param {string} [definition.idAttribute=id] The name of attribute that
 * identifies the model instance.
 * @param {string} [definition.cidPrefix=c] The prefix is used to create the
 * client id which is used to identify models locally.
 * You may want to override this if you're experiencing name clashes with model
 * ids.
 * @param {string} [definition.initialize] Define the initialization logic.
 * @returns {function} a function that mixes the class with a Backbone.Model
 * proxy.
 */
// export function Model (definition = {}) {
//     const BackboneModel = new Backbone.Model.extends(definition);

//     return decorator;

//     function decorator (target) {
//         target.finisher = finisher;
//     }

//     /**
//      * Mixes the class with a Backbone.Model proxy
//      * @param {function} Class the target class
//      * @return {Model} the mixed class
//      */
//     function finisher (Class) {
//         //
// }

/**
 * Backbone **Models** are the basic data object in the framework
 * frequently representing a row in a table in a database on your
 * server.
 * A discrete chunk of data and a bunch of useful, related methods for
 * performing computations and transformations on that data.
 * @typedef Model
 * @class
 * @see {@link http://backbonejs.org/#Model}
 */
class Model {

    /**
     * Create a point.
     * @param {number} attributes The x value.
     * @param {number} options The y value.
     */
    constructor (attributes, options) {
        // super(attributes, options);
        this[model] = BackboneModel(attributes, options);
    }

    /**
     * A hash of attributes whose current and previous value differ.
     * @type {object}
     */
    get changed () {
        return this[model].changed;
    }

    /**
     * idAttribute
     * @type {string}
     */
    get idAttribute () {
        return this[model].idAttribute;
    }

    /**
     * The prefix is used to create the client id which is used to
     * identify models locally.
     * You may want to override this if you're experiencing name
     * clashes with model ids.
     * @type {string}
     */
    get cidPrefix () {
        return this[model].cidPrefix;
    }

    /**
     * @returns {object} a plain object representing the model state
     */
    toJSON () {
        return this[model].toJSON();
    }

    /**
    * Get the value of an attribute.
    * @param {string} attr The attribute's name
    * @returns {any} The attribute's value
    */
    get (attr) {
        return this[model].get(attr);
    }

    /**
    * Get the HTML-escaped value of an attribute.
    * @param {string} attr The attribute's name
    * @returns {any} The HTML-escaped attribute's value
    */
    escape (attr) {
        return this[model].escape(attr);
    }

    /**
     * @param {string} attr The attribute's name
     * @returns {boolean} `true` if the attribute contains a value that
     * is not null or undefined.
     * */
    has (attr) {
        return this[model].has(attr);
    }

    /**
     * Test if the model's attributes contains all
     * of the key/value properties present in attrs.
     * @param {object} attrs used to check
     * @return {boolean} `true`
     */
    matches (attrs) {
        return this[model].matches(attrs);
    }

    /**
     * The names of the object's own enumerable properties.
     * @type {array.<string>}
     * @see {@link https://underscorejs.org/#keys}
     */
    get keys () {
        return this[model].keys();
    }

    /**
     * The values of the object's own properties.
     * @type {array.<any>}
     * @see {@link https://underscorejs.org/#values}
     */
    get values () {
        return this[model].values();
    }

    /**
     * A list of [key, value] pairs. The opposite of object.
     * @type {array.<array.<any>>}
     * @see {@link https://underscorejs.org/#pairs}
     */
    get pairs () {
        return this[model].pairs();
    }

    /**
     * A copy of the object where the keys have become the values and
     * the values the keys. For this to work, all of your object's
     * values should be unique and string serializable.
     * @type {object}
     * @see {@link https://underscorejs.org/#invert}
     */
    get invert () {
        return this[model].invert();
    }

    /**
     * A copy of the model's attributes, filtered to only have
     * values for the whitelisted keys (or array of valid keys).
     * Alternatively accepts a predicate indicating which keys to pick.
     * @see {@link https://underscorejs.org/#invert}
     * @returns {object} Filtered Model's attributes.
     */
    pick (...args) {
        return this[model].pick(...args);
    }

    /**
     * A copy of the model's attributes, filtered to omit the
     * blacklisted keys (or array of keys). Alternatively accepts
     * a predicate indicating which keys to omit.
     * @see {@link https://underscorejs.org/#omit}
     * @param {...string|function} keys The keys or a filter.
     * @returns {object} Filtered Model's attributes.
     */
    omit (...keys) {
        return this[model].omit(...keys);
    }

    /**
     * Check if the model's attributes contains no values (no
     * enumerable own-properties).
     * @see {@link https://underscorejs.org/#omit}
     * @returns {boolean} `true` if contains no values.
     */
    get isEmpty () {
        return this[model].isEmpty();
    }

    /**
     * Wrap the model's attributes into the underscore chain api.
     * @see {@link https://underscorejs.org/#chain}
     * @returns {object} the attributes wrapped by _.chain.
     */
    chain () {
        return this[model].chain();
    }

}

// export default Model;
