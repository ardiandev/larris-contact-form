/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, ColorPalette, PanelRow } from '@wordpress/components';
import { useState } from '@wordpress/element';

/**
 * Imports the CSS file for the block.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-styles/
 */

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit(props) {

	const { attributes, setAttributes } = props;
	const {btnBgColor, btnTextColor} = attributes;
	const { emailRecipent, setEmailRecipent } = props.attributes;
	return (
		<>
		<InspectorControls group="styles">
			{/* <PanelBody title={ __( 'Settings', 'larris-contact-form' ) }>
				<EmailRecipent attributes={attributes} setAttributes={setAttributes}/>
			</PanelBody> */}
			<PanelBody  title={ __( 'Button Color Settings', 'larris-contact-form' ) } initialOpen={ false }>
				<PanelRow>Background Color</PanelRow>
				<BtnBackgroundColor />
				<PanelRow>Text Color</PanelRow>	
				<BtnTextColor />
			</PanelBody>
		</InspectorControls>
		<div { ...useBlockProps() }>
			< FormEl btnBgColor={btnBgColor} btnTextColor={btnTextColor}/>
		</div>
		</>
	);
}


const BtnBackgroundColor = () => {
  const [ color, setColor ] = useState ( '#f00' )
  const colors = [
    { name: 'red', color: '#f00' },
    { name: 'white', color: '#fff' },
    { name: 'blue', color: '#00f' },
  ];
  return (
    <ColorPalette
      colors={ colors }
      value={ color }
      onChange={ ( color ) => setColor( color ) }
    />
  );
};

const BtnTextColor = () => {
	const [ color, setColor ] = useState ( '#f00' )
	const colors = [
	  { name: 'red', color: '#f00' },
	  { name: 'white', color: '#fff' },
	  { name: 'blue', color: '#00f' },
	];
	return (
	  <ColorPalette
		colors={ colors }
		value={ color }
		onChange={ ( color ) => setColor( color ) }
	  />
	);
  };

  const FormEl = ({btnBgColor, btnTextColor}) => {
	return (
		<>
			< YourName />
			< YourEmail />
			< Subject />
			< Message />
			< SubmitBtn btnBgColor={btnBgColor} btnTextColor={btnTextColor}  />
		</>
	)
  }


const YourName = () => {
  const [ className, setClassName ] = useState( '' );

  return (
    <TextControl
      label="Your Name"
      value={ className }
      onChange={ ( value ) => setClassName( value ) }
	  className="larris-contact-form__item"
    />
  );
};

const YourEmail = () => {
	const [ className, setClassName ] = useState( '' );
  
	return (
	  <TextControl
		label="Your Email"
		value={ className }
		onChange={ ( value ) => setClassName( value ) }
		className="larris-contact-form__item"
	  />
	);
  };


const Subject = () => {
	const [ className, setClassName ] = useState( '' );
  
	return (
	  <TextControl
		label="Subject"
		value={ className }
		onChange={ ( value ) => setClassName( value ) }
		className="larris-contact-form__item"
	  />
	);
  };


const Message = () => {
	const [ className, setClassName ] = useState( '' );
  
	return (
	  <TextareaControl
		label="Message"
		value={ className }
		onChange={ ( value ) => setClassName( value ) }
		className="larris-contact-form__item"
	  />
	);
  };

  const SubmitBtn = ({btnBgColor, btnTextColor}) => {
	console.log(btnBgColor)
	return (
		<button className="larris-contact-form-button" style={{backgroundColor: btnBgColor, color: btnTextColor}}  >
			{ __( 'Submit', 'larris-contact-form' ) }
		</button>
	)
  }