@extends('layouts.front')
@section('content')
@include('partials.global.common-header')

<style>
   /* ===== Base Resets and Global Styles ===== */
   * {
      margin: 0;
      padding: 0;
      color: #000000;
      font-size: Open Sans;
      font-family: 'Open Sans', sans-serif;
   }

   body {
      overflow-x: hidden;
      font-family: 'Open Sans', sans-serif;
   }

   /* ===== Hero Section Styles ===== */
   .celigin-hero-section {
      position: relative;
      height: 100vh;
      min-height: 600px;
      overflow: hidden;
      width: 100%;
   }

   .celigin-hero-image {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
      transition: transform 0.3s ease;
   }

   .celigin-hero-content {
      position: absolute;
      top: 10%;
      left: 5%;
      right: 5%;
      color: #ffffff;
      z-index: 1;
      max-width: 90%;
   }

   .celigin-hero-line {
      width: 35%;
      height: 4px;
      background-color: #ffffff;
      margin-bottom: 20px;
   }

   .celigin-hero-title {
      font-size: 40px;
      font-weight: 400;
      line-height: 1.2;
      color: #ffffff;
      max-width: 90%;
   }

   .hero-bottom-text {
      position: absolute;
      bottom: 5%;
      left: 50%;
      transform: translateX(-50%);
      color: #ffffff;
      font-size: 24px;
      font-weight: 500;
      text-transform: uppercase;
      text-align: center;
      width: 100%;
      padding: 0 15px;
      box-sizing: border-box;
   }

   /* Large Screens */
   @media screen and (min-width: 1920px) {
      .celigin-hero-section {
         height: 100vh;
      }

      .celigin-hero-image {
         transform: scale(1);
      }
   }

   /* Desktop Screens */
   @media screen and (max-width: 1919px) {
      .celigin-hero-section {
         height: 100vh;
      }

      .celigin-hero-image {
         transform: scale(1.05);
      }
   }

   /* Tablet Responsiveness */
   @media screen and (max-width: 1024px) {
      .celigin-hero-section {
         height: 90vh;
      }

      .celigin-hero-image {
         transform: scale(1.1);
      }

      .celigin-hero-title {
         font-size: 36px;
      }

      .hero-bottom-text {
         font-size: 22px;
      }
   }

   /* Mobile Responsiveness */
   @media screen and (max-width: 768px) {
      .celigin-hero-section {
         height: 75vh;
         min-height: 360px;
      }

      .celigin-hero-image {
         transform: scale(1.2);
      }

      .celigin-hero-content {
         top: 15%;
         left: 3%;
         right: 3%;
      }

      .celigin-hero-title {
         font-size: 23px;
         margin-top: -38px;
      }

      .hero-bottom-text {
         font-size: 18px;
         bottom: 3%;
      }

      .celigin-hero-line {
         width: 35%;
         height: 3px;
      }
   }

   /* Small Mobile Devices */
   @media screen and (max-width: 480px) {
      .celigin-hero-section {
         height: 30vh;
         min-height: 200px;
      }

      .celigin-hero-line {
         width: 41%;
         height: 3px;
      }

      .celigin-hero-image {
         transform: scale(1.3);
      }

      .celigin-hero-title {
         font-size: 12px;
         margin-top: -38px;
      }

      .hero-bottom-text {
         font-size: 14px;
      }
   }

   /* ===== Product Lineup Styles ===== */
   .celigin-container {
      margin: 0 auto;
      padding: 0 15px;
   }


   .celigin-custom-line {
      width: 65%;
      height: 2px;
      background-color: black;
      margin: auto;
   }

   .celigin-custom-heading {
      font-size: 65px;
      color: black;
      font-weight: 700;
      text-align: center;
   }

   .section-subtitle {
      text-align: center;
   }

   .skin-care-grid {
      display: grid;
      grid-template-columns: repeat(9, 1fr);
      grid-gap: 0;
      width: 100%;
   }

   .skin-care-grid .cell {
      border: 0.5px solid #878789;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: start;
   }

   .skin-care-grid .cell .top {
      background-color: #878789;
      color: #ffffff;
      padding: 0.5rem;
      text-align: center;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100px;
   }

   .skin-care-grid .cell .bottom {
      height: 570px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 1rem;
   }

   .skin-care-grid .cell .bottom img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
   }

   .line-arrow {
      display: flex;
      align-items: center;
      justify-content: center;
      max-width: 1000px;
      margin: 0 auto;
      /* Center horizontally */
   }

   .line-arrow::before {
      content: "";
      flex-grow: 1;
      height: 4px;
      background-color: #878789;
   }

   .line-arrow::after {
      content: "";
      display: inline-block;
      width: 0;
      height: 0;
      border-top: 10px solid transparent;
      border-bottom: 10px solid transparent;
      border-left: 10px solid #878789;
   }

   /* Tablet Breakpoint */
   @media (max-width: 1024px) {
      .skin-care-grid {
         grid-template-columns: repeat(6, 1fr);
         row-gap: 20px;
         column-gap: 0;
      }

      .celigin-custom-heading {
         font-size: 50px;
      }
   }

   /* Medium Tablet Breakpoint */
   @media (max-width: 768px) {
      .skin-care-grid {
         grid-template-columns: repeat(4, 1fr);
         row-gap: 30px;
      }

      .celigin-custom-heading {
         font-size: 45px;
      }

      .skin-care-grid .cell .top {
         height: 90px;
         font-size: 0.9rem;
         padding: 0.3rem;
      }

      .skin-care-grid .cell .bottom {
         height: 640px;
         padding: 0.5rem;
      }

      .skin-care-grid .cell .bottom img {
         max-width: 70%;
         max-height: 70%;
      }
   }

   @media (max-width: 690px) {
      .skin-care-grid {
         grid-template-columns: repeat(3, 1fr);
         row-gap: 40px;
         column-gap: 0;
      }

      .skin-care-grid .cell .top {
         height: 80px;
         font-size: 0.8rem;
      }

      .skin-care-grid .cell .bottom {
         height: 645px;
      }
   }

   /* Mobile Breakpoint */
   @media (max-width: 640px) {
      .skin-care-grid {
         grid-template-columns: repeat(3, 1fr);
         row-gap: 40px;
         column-gap: 0;
      }

      .celigin-custom-heading {
         font-size: 40px;
      }

      .skin-care-grid .cell .top {
         height: 70px;
      }

      .skin-care-grid .cell .bottom {
         height: 640px;
      }
   }

   /* Small Mobile Breakpoint */
   @media (max-width: 480px) {
      .skin-care-grid {
         row-gap: 50px;
         column-gap: 0;
      }

      .celigin-custom-heading {
         font-size: 30px;
      }

      .skin-care-grid .cell .top {
         font-size: 0.8rem;
         height: 60px;
      }

      .skin-care-grid .cell .bottom {
         height: 640px;
      }
   }

   /* ===== Main Ingredient Styles ===== */
   .bg-image {
      background-image: url("{{ asset('assets/brand/cp-background.png') }}");
      background-size: cover;
      background-position: center;
      width: 100%;
   }

   .celigin-unique {
      font-size: 30px;
      font-weight: 400;
      color: #000000;
      margin: 1.5rem 0;
      text-align: center;
   }

   .custom-line {
      height: 2px;
      background-color: #000;
   }

   /* ==================== Main Ingredient Section-1========== */
   .celigin-main-ingredient-section {
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      position: relative;
      padding: 3rem 0;
   }

   .celigin-ingredient-wrapper {
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
   }

   .celigin-ingredient-header {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 75%;
      margin-bottom: 1rem;
   }

   .celigin-header-title {
      margin-bottom: 0;
      white-space: nowrap;
      font-size: clamp(1.2rem, 4vw, 1.5rem);
      color: #000;
   }

   .celigin-header-line {
      height: 1.5px;
      background-color: #000;
      flex-grow: 1;
      margin-left: 1rem;
   }

   .celigin-unique-subtitle {
      font-size: clamp(1rem, 4vw, 30px);
      text-align: center;
      color: #000000;
   }

   .celigin-main-title {
      font-size: clamp(2.5rem, 8vw, 65px);
      font-weight: bold;
      color: #000;
      text-align: center;
   }

   .celigin-content-row {
      display: flex;
      align-items: center;
   }

   .celigin-glass-column {
      display: flex;
      justify-content: center;
      align-items: center;
   }

   .celigin-glass-image {
      max-width: 70%;
      height: auto;
   }

   .celigin-benefits-column {
      display: flex;
      flex-direction: column;
      justify-content: start;
      align-items: start;
   }

   .celigin-check-icon {
      width: clamp(20px, 4vw, 40px);
      height: clamp(20px, 4vw, 40px);
      margin-right: 0.5rem;
   }

   .celigin-benefit-text {
      font-size: clamp(0.85rem, 3vw, 32px);
      color: #000000;
   }

   .celigin-benefit-item {
      display: flex;
      align-items: center;
      margin-bottom: 1rem;
   }

   /* Responsive Adjustments */
   @media screen and (max-width: 1024px) {
      .celigin-ingredient-header {
         width: 85%;
      }
   }

   @media screen and (max-width: 768px) {
      .celigin-main-ingredient-section {
         padding: 2rem 0;
      }

      .celigin-content-row {
         flex-direction: column;
      }

      .celigin-glass-column,
      .celigin-benefits-column {
         width: 100%;
         max-width: 100%;
         text-align: center;
         margin-bottom: 1rem;
      }

      .celigin-glass-image {
         max-width: 50%;
      }

      .celigin-benefits-container {
         width: 100%;
         padding: 0 15px;
      }

      .celigin-benefit-item {
         justify-content: center;
      }

      .celigin-check-icon {
         margin-right: 0.5rem;
      }
   }

   @media screen and (max-width: 480px) {
      .celigin-glass-image {
         max-width: 70%;
      }

      .celigin-benefit-item {
         flex-direction: column;
         text-align: center;
         margin-bottom: 1.5rem;
      }

      .celigin-check-icon {
         margin-bottom: 0.5rem;
      }
   }

   /* ================Main Ingredient Section-2=========== */
   .celigin-ingredient-section-two {
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
   }

   .celigin-header-wrapper {
      margin-bottom: 2rem;
   }

   .celigin-section-header {
      width: 75%;
      display: flex;
      align-items: center;
      justify-content: space-between;
   }

   .celigin-section-title {
      font-size: clamp(1.2rem, 4vw, 1.5rem);
      color: #000;
      white-space: nowrap;
   }

   .celigin-header-line {
      height: 1.5px;
      background-color: #000;
      flex-grow: 1;
      margin-left: 1rem;
   }

   .celigin-unique-subtitle {
      font-size: clamp(1rem, 4vw, 1.5rem);
      text-align: center;
      color: #000000;
   }

   .celigin-main-title {
      font-size: clamp(2.5rem, 8vw, 4rem);
      font-weight: bold;
      color: #000;
      text-align: center;
   }

   .celigin-description {
      margin: 0 auto 2rem;
      font-size: clamp(0.9rem, 3vw, 30px);
      color: #000000;
      text-align: center;
      max-width: 90%;
   }

   .celigin-main-image {
      max-width: 100%;
      height: auto;
   }

   .celigin-info-section {
      margin-top: 2rem;
   }

   .celigin-info-row {
      height: auto;
      background-color: white;
      padding: 1rem;
      max-width: 1125px;
      margin: 0 auto;
   }

   .celigin-info-title {
      display: flex;
      align-items: center;
   }

   .celigin-info-heading {
      font-size: clamp(1rem, 4vw, 24px);
      font-weight: bold;
      color: #000;
      line-height: 1.3;
   }

   .celigin-info-text {
      font-size: clamp(0.9rem, 3vw, 24px);
      color: #000;
      line-height: 1.3;
   }

   /* Responsive Adjustments */
   @media screen and (max-width: 768px) {
      .celigin-section-header {
         width: 100%;
      }

      .celigin-info-row {
         flex-direction: column;
         text-align: center;
         padding: 1rem 0.5rem;
      }

      .celigin-info-title,
      .celigin-info-description {
         width: 100%;
         margin-bottom: 1rem;
      }

      .celigin-info-heading,
      .celigin-info-text {
         text-align: center;
      }

      .celigin-main-image {
         max-width: 100%;
      }
   }

   @media screen and (max-width: 480px) {
      .celigin-description {
         max-width: 100%;
      }
   }


   /* =============================Aging and Growth Factors Section============================ */
   .celigin-aging-section {
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
   }

   /* Header Styles - Unchanged */
   .celigin-section-header {
      width: 75%;
      display: flex;
      align-items: center;
      justify-content: space-between;
   }

   .celigin-section-title {
      font-size: 1.5rem;
      color: #000;
      white-space: nowrap;
   }

   .celigin-header-line {
      height: 1.5px;
      background-color: #000;
      flex-grow: 1;
      margin-left: 1rem;
   }


   /* Circle Container Styles - Refined */
   .celigin-circle-container {
      position: relative;
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 2rem;
   }

   .celigin-circle {
      width: 500px;
      height: 500px;
      border-radius: 50%;
      background-color: rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 22px;
      text-align: center;
      box-sizing: border-box;
      position: relative;
      overflow: hidden;
   }

   .celigin-circle-text {
      max-width: 55%;
      margin: 10px auto;
      font-weight: bold;
      line-height: 1.4;
      position: relative;
      z-index: 2;
   }

   .celigin-left-circle {
      margin-right: -60px;
      z-index: 1;
   }

   .celigin-right-circle {
      margin-left: -60px;
      z-index: 1;
   }

   .celigin-circle-overlap {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 35px;
      font-weight: bold;
      color: #000000;
      z-index: 3;
   }



   @media screen and (max-width: 1024px) {
      .celigin-circle {
         width: 450px;
         height: 370px;
      }

      .celigin-circle-text {
         max-width: 60%;
      }

      .celigin-left-circle {
         margin-right: -35px;
         z-index: 1;
      }

      .celigin-right-circle {
         margin-left: -45px;
         z-index: 1;
      }

      .celigin-circle-overlap {

         font-size: 25px;
      }
   }

   @media screen and (max-width: 768px) {
      .celigin-circle-container {
         flex-direction: column;
         align-items: center;
      }

      .celigin-circle {
         width: 400px;
         height: 400px;
      }

      .celigin-left-circle,
      .celigin-right-circle {
         margin: 0;
         position: static;
      }

      .celigin-circle-text {
         max-width: 70%;
         font-size: 0.95rem;
      }

      .celigin-left-circle {
         margin-bottom: -45px;
         z-index: 1;
      }

      .celigin-right-circle {
         margin-top: -45px;
         z-index: 1;
      }

   }


   @media screen and (max-width: 480px) {
      .celigin-circle {
         width: 280px;
         height: 280px;
      }

      .celigin-circle-text {
         max-width: 80%;
         font-size: 0.8rem;
      }

      .celigin-circle-overlap {
         font-size: 28px;
      }

      .celigin-left-circle {
         margin-bottom: -34px;
      }

      .celigin-right-circle {
         margin-top: -25px;
         z-index: 1;
      }

   }


   /* ====================== Permanent Luxury Section=================== */

   .bg-image {
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
   }

   .responsive-line {
      background-color: #333;
      height: 2px;
   }

   /* Tablet and Medium Screen Adjustments */
   @media screen and (max-width: 1024px) {
      .text-center h3 {
         font-size: 1.5rem !important;
      }

      .responsive-title {
         font-size: 1.8rem;
      }

      .celigin-unique {
         font-size: 1rem;
      }

      .w-40 {
         width: 60%;
      }
   }

   /* Mobile Adjustments */
   @media screen and (max-width: 768px) {
      .w-75 {
         width: 90%;
      }

      .responsive-line {
         margin: 0.5rem 0;
      }

      .responsive-title {
         font-size: 1.5rem;
      }

      .responsive-border {
         margin-bottom: 1rem;
      }

      .celigin-unique {
         font-size: 1rem;
         line-height: 1.4;
      }

      .w-40 {
         width: 80%;
      }
   }

   /* Small Mobile Adjustments */
   @media screen and (max-width: 480px) {
      .responsive-title {
         font-size: 1.2rem;
      }

      .responsive-text {
         font-size: 0.9rem;
      }

      .celigin-unique {
         font-size: 1rem;
      }

      .responsive-border img {
         max-width: 100%;
         height: auto;
      }

      .text-center h3 {
         font-size: 1rem !important;
      }
   }

   /* =========================Product Comparison Section========================= */

   .no-gutters {
      margin-right: 0;
      margin-left: 0;
   }

   .no-gutters>.col,
   .no-gutters>[class*="col-"] {
      padding-right: 0;
      padding-left: 0;
   }

   .CosCor-container {
      background-color: #3B5697;
      height: 630px;
      width: 670px;
   }

   .CosCor-content {
      background-color: #ffffff;
      height: 660px;
      width: 620px;
      margin: 30px 20px 20px 20px;
      border-radius: 25px;
   }

   .culture-medium-container {
      background-color: #D9D9D9;
      height: 530px;
      width: 670px;
   }

   .culture-medium-content {
      background-color: #ffffff;
      height: 660px;
      width: 620px;
      margin: 30px 20px 20px 20px;
      border-radius: 25px;
   }

   /* Overlapping Divs for Different Screen Sizes */
   .overlapping-divs {
      position: absolute;
      top: 0;
      left: 50%;
      transform: translateX(-50%);
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: space-evenly;
      align-items: center;
   }

   .overlapping-divs>div {
      background-color: #5D9AD2;
      color: #ffffff;
      font-weight: bold;
      border-radius: 30px;
      padding: 8px 18px;
      text-align: center;
   }


   /* Responsive Adjustments */
   @media (max-width: 1199px) {

      .CosCor-container,
      .culture-medium-container {
         width: 100%;
         max-width: 670px;
         height: auto;
      }

      .CosCor-content,
      .culture-medium-content {
         width: 100%;
         max-width: 620px;
         height: auto;
         margin: 20px 10px;
      }

      .comparison-row {
         display: flex;
         flex-direction: column;
      }

      .comparison-col {
         margin-bottom: 20px;
      }
   }


   /* Mobile Overlapping Divs */
   @media (max-width: 1199px) {
      .overlapping-divs {
         position: relative;
         flex-direction: row;
         flex-wrap: wrap;
         justify-content: center;
         gap: 10px;
         margin: 20px 0;
      }

      .overlapping-divs>div {
         margin: 5px;
      }
   }

   @media (max-width: 425px) {
      .container .text-center h2 {
         font-size: 1.3rem !important;
         margin-top: 11px;
      }
   }

   /* =====================================CosCor Information Section======================================== */

   .my-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 15px;
      padding: 15px;
   }

   .info-row {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #FECCBE;
      width: 85%;
      max-width: 1200px;
      height: 180px;
      text-align: center;
      padding: 0;
   }

   .info-title {
      flex: 0 0 25%;
      font-weight: bold;
      color: #000000;
      font-size: 1.8rem;
   }

   .info-description {
      flex: 1;
      color: #000000;
      line-height: 1.5;
      font-size: 26px;
      padding: 0 15px;
      text-align: left;
   }

   /* Media Queries */
   @media (max-width: 1024px) {
      .info-title {
         font-size: 1.6rem;
      }

      .info-description {
         font-size: 1rem;
      }
   }

   @media (max-width: 768px) {
      .info-row {
         flex-direction: column;
         justify-content: center;
         padding: 20px;
         width: 90%;
         gap: 10px;
      }

      .info-title {
         font-size: 1.5rem;
         margin-bottom: 10px;
         flex: 0 0 auto;
      }

      .info-description {
         font-size: 1rem;
      }
   }

   @media (max-width: 576px) {
      .info-row {
         width: 100%;
         padding: 15px;
         gap: 8px;
         border-radius: 8px;
         height: 265px;
      }

      .info-title {
         font-size: 1.4rem;
      }

      .info-description {
         font-size: 0.95rem;
         line-height: 1.4;
         margin-left: 0 !important;
      }
   }

   /* ================================ Product Section1 =========================== */

   .product-page {
      font-family: 'Arial', sans-serif;
      background-color: #f8f9fa;
   }

   .section-title-wrapper {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 2rem;
   }

   .product-details1 {
      font-size: 30px;
   }

   .product-headline1 {
      font-size: 48px;
      font-weight: bold;
      margin-bottom: 1.5rem;
      line-height: 1.3;
   }

   .section-title {
      margin-right: 1rem;
      font-weight: 600;
      color: #333;
   }

   /* Product Image Section */
   .product-image-wrapper {
      text-align: center;
   }

   .product-image {
      max-width: 90%;
      height: auto;
      object-fit: contain;
   }

   .product-detail1 {
      position: relative;
   }

   .left-col1 {
      border-right: 3px solid #000;
   }

   .product-title1,
   .product-subtitle1 {
      margin: 0;
      color: #000;
   }

   .right-col1 {
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      gap: 5px;
   }

   .product-info1 {
      color: #000;
   }

   .product-bottom1 {
      height: 100%;
      width: 100%;
      background-color: #fff;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      display: flex;
      justify-content: start;
      gap: 10px;
      flex-wrap: wrap;
      padding: 30px 6px;
      border-top: 2px #000 solid;
   }

   .product-righttitle1 {
      font-size: 30px;
      margin-bottom: 8px;
   }

   .product-main-title {
      font-weight: bold;
      font-size: 36px;
      margin-right: 1rem;
   }

   .product-title-separator {

      color: #000000;
      font-size: 6rem;
   }

   .product-capacity {
      font-size: 1rem;
      color: #000000;
   }

   .checkbox-container {
      display: flex;
      align-items: center;
      height: 125px;
   }

   .form-check {
      font-size: 1rem;
      text-align: center;
      height: 90px;
      display: flex;
      align-items: center;
   }

   h1.product-headline {
      font-size: 40px;
      font-weight: bold;
      margin-bottom: 1.5rem;
      line-height: 1.3;
   }

   /* Responsive Typography for h1.product-headline */

   /* For Large Desktops (1200px and above) */
   @media (max-width: 1200px) {
      h1.product-headline {
         font-size: 36px;
      }
   }

   /* For Medium to Large Tablets (992px to 1199px) */
   @media (max-width: 992px) {
      h1.product-headline {
         font-size: 32px;
      }
   }

   /* For Tablets and Smaller Screens (768px to 991px) */
   @media (max-width: 768px) {
      h1.product-headline {
         font-size: 28px;
      }
   }

   /* For Small Mobile Screens (576px to 767px) */
   @media (max-width: 576px) {
      h1.product-headline {
         font-size: 24px;
      }
   }

   @media (max-width: 400px) {
      h1.product-headline {
         font-size: 20px;
      }
   }


   .feature {
      display: flex;
      align-items: center;
      justify-content: start;
      gap: 7px;
      flex: 1 1 auto;
      min-width: 200px;
   }

   .icon {
      width: 24px;
      height: 24px;
   }

   .feature-text {
      font-size: 20px;
      font-weight: bold;
   }

   /* Responsive Adjustments for Product Page */

   /* Base Layout Adjustments */
   @media (max-width: 992px) {
      .product-content {
         flex-direction: column;
      }

      .product-image-section,
      .product-description-section {
         padding-left: 0;
      }

      .product-image {
         max-width: 80%;
      }

      .product-title-wrapper {
         flex-direction: column;
         text-align: center;
         justify-content: center;
      }

      .product-title-separator {
         display: none;
         margin: 0;
      }

      /* Typography Adjustments */
      .product-subtitle,
      .product-headline,
      .product-details,
      .custom-checkbox-label {
         font-size: 0.9rem;
         text-align: center;
      }

      /* Feature and Input Adjustments */
      .feature-checkbox {
         justify-content: center;
      }

      .custom-checkbox-input {
         transform: scale(1.2);
         margin-right: 0.75rem;
      }
   }

   @media (max-width: 575.98px) {
      .product-page {
         font-size: 14px;
      }

      .product-headline1 {
         font-size: 16px;
      }

      .product-details1 {
         font-size: 18px;
      }

      .product-righttitle1 {
         font-size: 20px;
      }

      .product-subtitle {
         font-size: 16px;
      }

      .product-headline {
         font-size: 22px;
      }

      .product-details {
         font-size: 16px;
      }

      .feature-text {
         font-size: 14px;
      }

      .product-main-title {
         font-size: 22px;
      }

      .product-title-separator {
         font-size: 3rem;
      }
   }

   /* Small Devices (Mobile Landscape) */
   @media (min-width: 576px) and (max-width: 767.98px) {
      .product-page {
         font-size: 15px;
      }

      .product-headline1 {
         font-size: 18px;
      }

      .product-details1 {
         font-size: 22px;
      }

      .product-righttitle1 {
         font-size: 24px;
      }

      .product-subtitle {
         font-size: 20px;
      }

      .product-headline {
         font-size: 26px;
      }

      .product-details {
         font-size: 20px;
      }

      .feature-text {
         font-size: 16px;
      }

      .product-main-title {
         font-size: 26px;
      }

      .product-title-separator {
         font-size: 4rem;
      }
   }

   /* Medium Devices (Tablets) */
   @media (min-width: 768px) and (max-width: 991.98px) {
      .product-page {
         font-size: 16px;
      }

      .product-headline1 {
         font-size: 34px;
      }

      .product-details1 {
         font-size: 26px;
      }

      .product-righttitle1 {
         font-size: 28px;
      }

      .product-subtitle {
         font-size: 24px;
      }

      .product-headline {
         font-size: 30px;
      }

      .product-details {
         font-size: 24px;
      }

      .feature-text {
         font-size: 18px;
      }

      .product-main-title {
         font-size: 30px;
      }

      .product-title-separator {
         font-size: 5rem;
      }
   }

   /* Large Devices (Desktops) */
   @media (min-width: 992px) and (max-width: 1199.98px) {
      .product-page {
         font-size: 17px;
      }

      .product-headline1 {
         font-size: 40px;
      }

      .product-details1 {
         font-size: 28px;
      }

      .product-righttitle1 {
         font-size: 32px;
      }

      .product-subtitle {
         font-size: 26px;
      }

      .product-headline {
         font-size: 36px;
      }

      .product-details {
         font-size: 26px;
      }

      .feature-text {
         font-size: 20px;
      }

      .product-main-title {
         font-size: 34px;
      }

      .product-title-separator {
         font-size: 5.5rem;
      }
   }

   /* Extra Large Devices (Large Desktops) */
   @media (min-width: 1200px) {
      .product-page {
         font-size: 18px;
      }

      .product-headline1 {
         font-size: 48px;
      }

      .product-details1 {
         font-size: 30px;
      }

      .product-righttitle1 {
         font-size: 34px;
      }

      .product-subtitle {
         font-size: 28px;
      }

      .product-headline {
         font-size: 40px;
      }

      .product-details {
         font-size: 28px;
      }

      .feature-text {
         font-size: 22px;
      }

      .product-main-title {
         font-size: 36px;
      }

      .product-title-separator {
         font-size: 6rem;
      }
   }

   /* ================================ Product Section2 =========================== */

   .product-page {
      background-color: #f8f9fa;
      font-family: 'Arial', sans-serif;
   }

   .product-image {
      max-width: 100%;
      height: auto;
   }

   .product-main-title {
      font-weight: bold;
      font-size: 36px;
      margin-right: 1rem;
   }

   .checkbox-container .form-check-label {
      font-size: 1rem;
      text-align: center;
   }

   .form-check-label {
      text-align: left;
      margin-left: 8px;
      line-height: 1.5;
      word-wrap: break-word;
   }

   .product-description-wrapper {
      padding: 1rem;
   }

   .product-subtitle {

      color: #000;
      margin-bottom: 1rem;
   }

   .product-headline {
      font-size: 40px;
      font-weight: bold;
      margin-bottom: 1.5rem;
      line-height: 1.3;
   }

   .product-feature-list {
      font-size: 30px;
      list-style: disc;
   }

   .product-feature-list li {
      margin-bottom: 0.6rem;
   }

   .feature2 {
      display: flex;
      align-items: start;
      justify-content: start;
      gap: 7px;
      flex: 1 1 auto;
   }

   /* Responsive Media Queries for Product Features and Layout */

   @media (max-width: 1200px) {
      .product-feature-list {
         font-size: 28px;
         text-align: start;
      }

      .product-description-wrapper p {
         text-align: left;
      }
   }

   @media (max-width: 992px) {
      .product-content {
         flex-direction: column;
      }

      .product-image {
         max-width: 100%;
      }

      .product-title-wrapper {
         flex-direction: column;
         text-align: center;
      }

      .product-feature-list {
         font-size: 26px;
         text-align: start;
      }

      .product-description-wrapper p {
         text-align: left;
      }
   }

   @media (max-width: 768px) {
      .product-feature-list {
         font-size: 24px;
         text-align: start;
      }

      .product-description-wrapper p {
         text-align: left;
      }
   }

   @media (max-width: 576px) {
      .product-feature-list {
         font-size: 22px;
      }

      .product-description-wrapper p {
         text-align: left;
      }
   }

   @media (max-width: 400px) {
      .product-feature-list {
         font-size: 20px;
         text-align: start;
      }

      .product-description-wrapper p {
         text-align: left;
      }
   }

   /* ================================ Product Section3 =========================== */
   .product-page {
      font-family: 'Arial', sans-serif;
      background-color: #f8f9fa;
   }

   .section-title-wrapper {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 2rem;
   }

   .section-title {
      margin-right: 1rem;
      font-weight: 600;
      color: #333;
   }

   .product-image-wrapper {
      border: 2px solid #000;
      border-bottom: none;

   }

   .product-image {
      width: 100%;
      height: auto;
      object-fit: contain;
      border-bottom: 2px solid #000;
   }

   .product-title-container {
      display: flex;
      justify-content: center;
      align-items: center;

   }

   .product-title-wrapper {
      display: flex;
      align-items: center;
   }

   .product-features-container {
      background-color: white;
      border-left: 2px solid black;
      border-right: 2px solid black;
      padding: 1rem;
      margin-top: 1rem;
   }

   .feature-checkbox {
      display: flex;
      align-items: center;
      margin-right: 1rem;
   }

   .custom-checkbox-input {
      margin-right: 0.5rem;
   }

   .custom-checkbox-label {
      user-select: none;
   }

   .product-description {
      font-size: 1.1rem;
      line-height: 1.6;
      color: #333;
      margin-top: 1.5rem;
   }



   /* Top Section */
   .top-title {
      font-size: 36px;
      font-weight: bold;
   }

   .top-subtitle {
      font-size: 36px;
      font-weight: bold;
   }

   .top-description {
      font-size: 0.9rem;
      color: #777;
   }

   /* Responsive Typography */
   @media (max-width: 1200px) {

      .top-title,
      .top-subtitle {
         font-size: 32px;
      }

      .top-description {
         font-size: 0.85rem;
      }
   }

   @media (max-width: 992px) {

      .top-title,
      .top-subtitle {
         font-size: 28px;
      }

      .top-description {
         font-size: 0.8rem;
      }
   }

   @media (max-width: 768px) {

      .top-title,
      .top-subtitle {
         font-size: 24px;
      }

      .top-description {
         font-size: 0.75rem;
      }
   }

   @media (max-width: 576px) {

      .top-title,
      .top-subtitle {
         font-size: 22px;
      }

      .top-description {
         font-size: 0.7rem;
      }
   }

   @media (max-width: 400px) {

      .top-title,
      .top-subtitle {
         font-size: 20px;
      }

      .top-description {
         font-size: 0.65rem;
      }
   }


   /* Right Column */
   .right-column {
      border-left: 2px solid black;
      padding-left: 1rem;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
   }

   .capacity,
   .details {
      font-size: 0.9rem;
      margin: 0;
      color: #555;
   }

   .bordered-div {
      border: none;
      border-top: 2px solid black;
      background-color: #fff;
      padding: 1rem 0;
      width: 100%;
      display: flex;
      justify-content: space-around;
      gap: 10px;
      flex-wrap: wrap;
      padding-left: 20px;
   }

   .top-title,
   .top-subtitle {
      font-size: 36px;
      font-weight: bold;
   }

   .top-description {
      font-size: 0.9rem;
      color: #777;
   }

   /* Responsive Typography and Layout Adjustments */
   @media (max-width: 1200px) {

      .top-title,
      .top-subtitle {
         font-size: 32px;
      }

      .top-description {
         font-size: 0.85rem;
      }
   }

   @media (max-width: 992px) {

      .top-title,
      .top-subtitle {
         font-size: 28px;
      }

      .top-description {
         font-size: 0.8rem;
      }

      .product-image-section {
         border-right: none;
      }

      .product-title-wrapper {
         flex-direction: column;
         text-align: center;
      }

      .product-title-separator {
         display: none;
      }

      .product-features-container {
         border-right: 2px solid black;
      }

      .product-description-section {
         padding: 1.5rem;
      }
   }

   @media (max-width: 768px) {

      .top-title,
      .top-subtitle {
         font-size: 24px;
      }

      .top-description {
         font-size: 0.75rem;
      }
   }

   @media (max-width: 576px) {

      .top-title,
      .top-subtitle {
         font-size: 22px;
      }

      .top-description {
         font-size: 0.7rem;
      }
   }

   @media (max-width: 400px) {

      .top-title,
      .top-subtitle {
         font-size: 20px;
      }

      .top-description {
         font-size: 0.65rem;
      }
   }

   /* ========================================product section4======================================== */
   /* Custom Product Section Styles */
   .celigin-product-section {
      background-size: cover;
      background-position: center;
      padding: 3rem 0;
   }

   .celigin-product-section__header {
      display: flex;
      align-items: center;
      width: 100%;
      margin-bottom: 2rem;
   }

   .celigin-product-section__title {
      margin-bottom: 0;
      white-space: nowrap;
   }

   .celigin-product-section__divider {
      flex-grow: 1;
      height: 1px;
      background-color: #000;
      margin-left: 1rem;
   }

   .celigin-product-section__image {
      max-width: 100%;
      height: auto;
      object-fit: contain;
   }

   .celigin-product-section__details {
      display: flex;
      flex-direction: column;
      justify-content: center;
      height: 100%;
   }

   .celigin-product-section__name {
      font-size: 1.5rem;
      margin-bottom: 1rem;
   }

   .celigin-product-section__headline {
      font-size: 2.5rem;
      margin-bottom: 1rem;
   }

   .celigin-product-section__description {
      font-size: 30px;
      line-height: 1.5;
      margin-top: 2rem;
   }

   /* Responsive Adjustments */
   @media (max-width: 991px) {
      .celigin-product-section__headline {
         font-size: 2rem;
      }

      .celigin-product-section__description {
         font-size: 1rem;
      }
   }

   @media (max-width: 767px) {
      .celigin-product-section {
         padding: 1.5rem 0;
      }

      .celigin-product-section__header {
         margin-bottom: 1rem;
      }

      .celigin-product-section__name {
         font-size: 1.1rem !important;
      }

      .celigin-product-section__headline {
         font-size: 1.50rem !important;
      }

      .celigin-product-section__description {
         font-size: 1rem !important;
         margin-top: 1rem;
      }
   }

   /* ========================================product section5======================================== */
   .celigin-products-section__header {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 2rem;
      width: 100%;
   }

   .product-header5 {
      padding: 20px 20px 0 20px;
   }


   .celigin-products-section__title {
      margin-right: 1rem;
      white-space: nowrap;
   }

   .celigin-products-section__divider {
      flex-grow: 1;
      height: 1px;
      background-color: #000;
   }

   .celigin-product-card {
      background-color: #F5F5F5;
      border: 2px solid #000;
      border-bottom: none;
      height: 100%;
   }

   .celigin-product-card__image {
      border-bottom: 2px solid #000;
      width: 100%;
      object-fit: cover;
   }

   .celigin-product-card__details {
      background-color: white;
      padding: 1.5rem;
      border-radius: 0.5rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
   }

   .celigin-product-card__capacity {
      font-size: 0.9rem;
      margin-bottom: 0.5rem;
   }

   .celigin-product-card__name {
      color: #333;
      margin-bottom: 1rem;
   }

   .celigin-product-card__description {
      color: #666;
      margin-bottom: 1rem;
   }

   .celigin-product-benefits {
      border-top: 2px solid #000;
      padding-top: 1rem;
   }

   .celigin-benefit-item {
      display: flex;
      align-items: center;
      margin-bottom: 0.5rem;
   }

   .celigin-benefit-icon {
      width: 20px;
      margin-right: 0.5rem;
   }

   .celigin-product-details {
      margin-top: 2rem;
   }

   @media (max-width: 991px) {
      .celigin-product-card {
         margin-bottom: 1.5rem;
      }

      .celigin-products-section__header {
         width: 90%;
         margin: 0 auto 1.5rem;
      }
   }

   @media (max-width: 767px) {
      .celigin-product-card__details {
         padding: 1rem;
      }

      .celigin-product-card__name {
         font-size: 1.25rem !important;
      }

      .celigin-product-card__description {
         font-size: 1rem !important;
      }
   }

   .product-header {
      padding: 16px;
   }

   .product-title5 {
      margin-bottom: 4px;
   }

   .product-capacity5 {
      text-align: right;
      margin-bottom: -32px;
   }

   .product-name5 {
      margin-bottom: 4px;
   }

   .bordered-div5 {
      border-top: 2px solid black;
      background-color: #fff;
      padding: 1rem 0;
      width: 100%;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      height: 100%;

   }

   .feature5 {
      display: flex;
      align-items: center;
      text-align: left;

      width: calc(33% - 1rem);
      min-width: 150px;
   }

   .feature-row5:last-child {
      justify-content: center;
   }

   .icon5 {
      width: 25px;
      height: 25px;
   }

   .feature-text5 {
      font-size: 16px;
      font-weight: bold;
   }

   .feature-text5.large5 {
      font-size: 20px;
   }

   .product-description {
      font-size: 14px;
      margin-bottom: 16px;
   }

   .product-features {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      border-top: 2px solid black;
      border-left: 2px solid black;
      background-color: white;
      padding: 16px;
   }

   .feature-item {
      display: flex;
      align-items: center;
      gap: 8px;
   }

   .feature-icon {
      width: 12px;
      height: 12px;
   }

   .feature-text {
      font-size: 16px;
      text-align: start;
   }

   /* ========================================product section6======================================== */
   .product-info-container {
      background-color: white;
      border-left: 2px solid black;
      border-right: 2px solid black;
   }

   .product-header {
      margin-bottom: 16px;
   }

   .product-name {
      font-size: 20px;
      margin-bottom: 4px;
   }

   .product-subtitle {
      font-size: 18px;
      margin-bottom: 8px;
   }

   .product-description {
      font-size: 14px;
   }

   .product-details {
      font-size: 14px;
   }

   .product-capacity {
      margin-bottom: 4px;
   }

   @media (max-width: 1200px) {


      .product--cont .row {
         flex-wrap: wrap;
      }

      .product--cont .product--row>.col-5 {
         width: 100%;
         max-width: 100%;
         flex: 0 0 100%;
         padding: 0 15px !important;
         margin: 0 !important;
         display: flex;
         flex-direction: column;
         align-items: center;
      }

      .product--cont .product--row>.col-6 {
         width: 100%;
         max-width: 100%;
         flex: 0 0 100%;
         padding: 0 15px;
         text-align: center;
         margin-top: 2rem;
      }

      .product--cont .product--row>.col-5 img {
         width: 100% !important;
         max-width: 500px;
      }

      .product-info-container {
         width: 100%;
         max-width: 500px;
      }
   }

   @media (max-width: 768px) {
      .product--cont .product--row>.col-5 img {
         width: 90% !important;
      }

      .product-header6 h2 {
         font-size: 1.5rem;
      }

      .fs-1 {
         font-size: 1.75rem !important;
      }

      .fs-3 {
         font-size: 1rem !important;
      }


   }

   @media (max-width: 425px) {
      .product-info-container {
         width: 90%;
         max-width: 428px;
      }
   }

   /* ========================================product section7======================================== */
   .detail-container7 {
      padding: 20px;

   }

   .title7 {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
   }

   .content-wrapper7 {
      display: flex;
      flex-direction: column;
   }

   .item7 {
      display: flex;
      flex-direction: column;
   }

   .number7 {
      font-size: 28px;
      margin-bottom: 8px;
   }

   .description7 {
      font-size: 28px;
      line-height: 1.3;
   }

   .content-container7 {
      text-align: left;
   }

   .title7 {
      font-size: 22px;
      font-weight: bold;
      margin-bottom: 15px;
   }


   .image7 {
      width: 500px;
   }

   .cycle-info7 {
      font-size: 16px;
      line-height: 1.8;
      margin-bottom: 15px;
      color: #333;
   }

   .additional-info7 {
      font-size: 35px;
      line-height: 1.3;
      color: #000;
      font-weight: bold;
      padding-right: 120px;
   }

   @media (max-width: 1200px) {

      .product--cont .product--row {
         flex-wrap: wrap;
      }

      .product--cont .product--row>.col-md-6 {
         width: 100%;
         max-width: 100%;
         flex: 0 0 100%;
         padding: 0 15px !important;
         margin-bottom: 2rem;
      }


      .detail-container7 {
         width: 100%;
         max-width: 500px;
         margin: 1rem auto;
      }

      .content-container7 {
         text-align: center !important;
      }

      .content-container7 h2 {
         text-align: center;
         margin-bottom: 1rem;
      }

      .image7 {
         width: 100% !important;
         max-width: 400px;
         margin: 1rem auto;
         display: block;
      }

      .cycle-info7,
      .content-container7>div {
         text-align: center;
      }

      .additional-info7 {
         text-align: center;
         padding-right: 0 !important;
      }
   }

   @media (max-width: 768px) {
      .title7 {
         font-size: 20px;
      }

      .number7,
      .description7 {
         font-size: 22px;
      }

      .content-container7 h2 {
         font-size: 1.5rem;
         line-height: 1.3;
      }

      .fs-5 {
         font-size: 1rem !important;
      }

      .additional-info7 {
         font-size: 1.5rem !important;
      }

      .cycle-info7 h3 {
         font-size: 1.25rem;
      }
   }

   /* =============================================product section8===================================== */
   .feature-img {
      width: 100%;
      max-width: 100%;
      height: auto;
      transition: transform 0.3s ease;
   }


   .feature-title {
      font-size: 24px;
      color: #555;
      font-weight: bold;
      margin-bottom: 10px;
   }

   .feature-description {
      font-size: 20px;
      color: #777;
      line-height: 1.5;
   }

   .section-title8 {
      font-size: 48px;
      font-weight: bold;
      color: #666;
      margin-left: 12px;
      margin-bottom: 30px;
   }

   @media (max-width: 1200px) {
      .product--row .row {
         display: flex;
         flex-direction: row;
         align-items: center;
         justify-content: start;
      }

      .product--row .col-4 {
         flex: 0 0 30%;
         padding: 10px;
      }

      .product--row .col-8 {
         flex: 0 0 65%;
         padding: 10px;
      }

      .feature-title {
         font-size: 20px;
      }

      .feature-description {
         font-size: 16px;
      }
   }

   @media (max-width: 992px) {
      .product--row {
         display: flex;
         flex-direction: column;
         align-items: flex-start;
      }

      .product--row .col-4 {
         flex: 0 0 100%;
         padding: 10px;
      }

      .product--row .col-8 {
         flex: 0 0 100%;
         padding: 10px;
      }


      .feature-title {
         font-size: 18px;
      }

      .feature-description {
         font-size: 16px;
      }

      .section-title8 {
         font-size: 32px;
         margin-left: 12px;
         margin-bottom: 20px;
      }
   }

   @media (max-width: 768px) {
      .product--row {
         display: flex;
         flex-direction: column;
         align-items: flex-start;
      }

      .product--row .col-4 {
         flex: 0 0 100%;
         padding: 10px;
      }

      .product--row .col-8 {
         flex: 0 0 100%;
         padding: 10px;
      }

      .feature-title {
         font-size: 16px;
      }

      .feature-description {
         font-size: 16px;
      }

      .section-title8 {
         font-size: 32px;
         margin-left: 12px;
         margin-bottom: 15px;
      }
   }

   @media (max-width: 576px) {
      .product--row {
         display: flex;
         flex-direction: column;
         align-items: flex-start;
      }

      .product--row .col-4 {
         flex: 0 0 100%;
         padding: 5px;
      }

      .product--row .col-8 {
         flex: 0 0 100%;
         padding: 5px;
      }


      .feature-title {
         font-size: 16px;
      }

      .feature-description {
         font-size: 16px;
      }

      .section-title8 {
         font-size: 20px;
         margin-bottom: -20px;
      }

      .my-5 {
         margin-top: 1rem !important;
         margin-bottom: 0.5rem !important;
      }
   }



   /* =====================================================================product sectopn-20========================================== */
   .custom-gap22 {
      gap: 4rem;

   }

   .image-container22 {
      max-width: 180px;
      height: auto;
   }

   /* =====================================================================product sectopn-21========================================== */

   .galvanic21 {
      height: 200px;
      position: relative;
   }

   .galvanic-top21 {
      width: 70%;
      border-bottom: 2px solid #000;
      padding: 10px;
      margin-left: 72px;
   }

   .galvanic-bottom21 {
      width: 70%;
      font-size: 14px;
      margin-left: 70px;
   }

   .galvanic-image21 {
      border-radius: 50%;
      width: 211px;
      right: 20px;
      bottom: -3px;
      margin-right: -70px;
   }


   .vibration21 {
      grid-column: 4;
      grid-row: 1;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px;
      height: 200px;
   }

   .vibration-image21 {
      border-radius: 50%;
      position: relative;
      width: 200px;
      margin-right: -79px;
   }

   @media (max-width: 1200px) {
      .container-fluid.bg-image {
         padding-top: 2rem !important;
         padding-bottom: 2rem !important;
      }


      /* Galvanic Section Responsive Design */
      .galvanic21 {
         height: auto !important;
         position: relative;
         padding-bottom: 220px !important;
      }

      .galvanic-top21 {
         width: 100% !important;
         margin-left: 0 !important;
         flex-direction: column !important;
         align-items: center !important;
         text-align: center !important;
         border-bottom: 2px solid #000;
         padding-bottom: 15px !important;
      }

      .galvanic-top21 .left,
      .galvanic-top21 .right {
         width: 100% !important;
         text-align: center !important;
         margin-bottom: 10px;
      }

      .galvanic-bottom21 {
         width: 100% !important;
         margin-left: 0 !important;
         text-align: center !important;
         padding: 0 15px;
      }

      .galvanic-image21 {
         position: relative !important;
         right: auto !important;
         bottom: auto !important;
         margin: 20px auto !important;
         display: block;
      }

      /* Vibration Section Responsive Design */
      .vibration21 {
         flex-direction: column !important;
         align-items: center !important;
         height: auto !important;
         padding: 20px 15px !important;
         text-align: center !important;
      }

      .vibration21 .left {
         margin-bottom: 15px;
         padding: 0 !important;
      }

      .vibration21 .right {
         max-width: 100% !important;
         margin-bottom: 15px;
      }

      .vibration-image21 {
         position: relative !important;
         bottom: auto !important;
         margin: 20px auto !important;
         display: block;
      }
   }

   @media (max-width: 768px) {

      /* Further Typography Adjustments */
      .galvanic-top21 .left {
         font-size: 1.5rem !important;
      }

      .galvanic-top21 .right,
      .vibration21 .right {
         font-size: 1rem !important;
      }

      .galvanic-bottom21,
      .vibration21 .right {
         font-size: 0.875rem !important;
      }

      .galvanic-image21,
      .vibration-image21 {
         width: 150px !important;
      }
   }

   /* Ensure images are responsive */
   .galvanic-image21,
   .vibration-image21 {
      max-width: 100%;
      height: auto;
      border-radius: 50%;
   }

   /* =====================================================================product sectopn-22======================================== */
   .step-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      grid-template-rows: repeat(2, 1fr);
      gap: 20px;
   }

   .step-card {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      padding: 6px;

   }

   .step-card img {
      max-width: 250px;
      margin-bottom: 15px;
   }

   .step-card h5 {
      margin-bottom: 10px;
      font-size: 20px;
      font-weight: 600;
   }

   .step-card p {
      font-size: 18px;
      color: #666;
      text-align: center;
      font-weight: 500;
   }

   .step-card ul {
      font-size: 14px;
      color: #666;
      text-align: left;
      padding: 0;
      display: flex;
      flex-wrap: wrap;
   }

   .step-card ul li {
      margin-right: 15px;
      margin-bottom: 5px;
      list-style: none;
      position: relative;
      padding-left: 20px;
   }

   .step-card ul li.green::before {
      content: "• ";
      color: green;
      font-size: 32px;
      position: absolute;
      left: 0;
      top: -14px;
   }

   .step-card ul li.red::before {
      content: "• ";
      color: red;
      font-size: 32px;
      position: absolute;
      left: 0;
      top: -14px;
   }


   /* Existing styles with responsive modifications */
   .step-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      grid-template-rows: repeat(2, 1fr);
      gap: 20px;
   }

   /* Tablet Responsiveness */
   @media screen and (max-width: 1024px) {
      .step-grid {
         grid-template-columns: repeat(2, 1fr);
         grid-template-rows: repeat(3, 1fr);
         gap: 15px;
      }

      .step-card img {
         max-width: 200px;
      }

      .step-card h5 {
         font-size: 16px;
      }

      .step-card p {
         font-size: 13px;
      }

      .step-card ul {
         font-size: 12px;
      }
   }

   /* Mobile Responsiveness */
   @media screen and (max-width: 768px) {
      .step-grid {
         grid-template-columns: 1fr;
         grid-template-rows: repeat(6, auto);
         gap: 10px;
      }

      .step-card {
         padding: 4px;
      }

      .step-card img {
         max-width: 180px;
         margin-bottom: 10px;
      }

      .step-card h5 {
         font-size: 14px;
         margin-bottom: 8px;
      }

      .step-card p {
         font-size: 12px;
      }

      .step-card ul {
         font-size: 11px;
         justify-content: center;
      }

      .step-card ul li {
         margin-right: 10px;
         padding-left: 15px;
      }

      .step-card ul li::before {
         font-size: 28px;
         top: -12px;
      }
   }

   /* Small Mobile Responsiveness */
   @media screen and (max-width: 480px) {
      .celigin-section-header {
         width: 90% !important;
      }

      .step-card img {
         max-width: 150px;
      }

      .step-card h5 {
         font-size: 13px;
      }

      .step-card p {
         font-size: 11px;
      }
   }

   /* =====================================================================product section-23========================================== */

   .celigin-ingredient-section-two {
      position: relative;
      padding: 3rem 0;
      background: #f8f9fa;
   }

   .celigin-header-line {
      border-bottom: 2px solid #000;
   }


   .celigin-container .d-flex-center {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
   }

   .celigin-container .qr-code {
      width: 180px;
      height: 180px;
      object-fit: cover;
      border-radius: 10px;
   }

   .celigin-container .img-fluid {
      max-width: 100%;
      height: auto;
   }

   @media (max-width: 768px) {
      .celigin-container .vh-100 {
         height: auto !important;
      }

      .celigin-container .row {
         flex-direction: column;
         align-items: center;
         gap: 10px;
      }

      .celigin-container .col-lg-8,
      .celigin-container .col-lg-4 {
         width: 100%;
      }

      .celigin-container .qr-code {
         margin-top: 1rem;
         width: 150px;
         height: 150px;
      }
   }

   /* =====================================================================product section-24========================================== */


   .ingredient-section .row {
      justify-content: center;
      align-items: center;
   }

   .ingredient-section .col-md-4 {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      padding: 20px;
   }

   .ingredient-section img {
      max-width: 300px;
      margin-bottom: 10px;
   }

   .ingredient-section h5 {
      font-size: 30px;
      margin-bottom: 10px;
   }

   /* ============================additional utility======================== */
   .bg-padding {
      padding-top: 10px;
      padding-bottom: 10px;
   }

   @media (min-width: 768px) {
      .bg-padding {
         padding-top: 20px;
         padding-bottom: 20px;
      }
   }

   @media (min-width: 1024px) {
      .bg-padding {
         padding-top: 40px;
         padding-bottom: 40px;
      }
   }
</style>

<!-- =========================================Hero Section================================ -->
<section class="celigin-hero-section">
   <img src="{{ asset('assets/brand/NEW-BANNER-1.png') }}" alt="Celigin Hero Image" class="celigin-hero-image">
   <div class="celigin-hero-content">
      <div class="celigin-hero-line mb-5"></div>
      <h4 class="celigin-hero-title">
         CELIGIN<br>Product Educational<br>Resource
      </h4>
   </div>
   <div class="hero-bottom-text">
      CELIGIN
   </div>
</section>

<!-- ========================Product Lineup================================== -->
<div class="container my-5 celigin-container">
   <div class="celigin-custom-line"></div>
   <h1 class="text-center my-2 celigin-custom-heading">Product Lineup</h1>
   <p class="text-center mb-5 py-2 section-subtitle">
      All of celigin products contain CosCor </p>
   <div class="skin-care-grid">
      <div class="cell">
         <div class="top ">Removes body</div>
         <div class="bottom">
            <img src="{{ asset('assets/brand/cppfoam.png') }}" alt="Skin Care Icon">
            <p class="text-center">Foam Cleansers</p>
         </div>
      </div>
      <div class="cell">
         <div class="top">Smoothens skin</div>
         <div class="bottom">
            <img src="{{ asset('assets/brand/cpptoner.png') }}" alt="Skin Care Icon">
            <p class="text-center">Toner Pads</p>
         </div>
      </div>
      <div class="cell">
         <div class="top">Moisturizing skin</div>
         <div class="bottom">
            <img src="{{ asset('assets/brand/cppmasks.png') }}" alt="Skin Care Icon">
            <p class="text-center">Masks</p>
         </div>
      </div>
      <div class="cell">
         <div class="top">Supplies oil and moisture</div>
         <div class="bottom">
            <img src="{{ asset('assets/brand/cppoil.png') }}" alt="Skin Care Icon">
            <p class="text-center">Oil Mist</p>
         </div>
      </div>
      <div class="cell">
         <div class="top">Improves skin tone and wrinkles</div>
         <div class="bottom">
            <img src="{{ asset('assets/brand/cppserum2.png') }}" alt="Skin Care Icon">
            <p class="text-center">First Essence</p>
            <img src="{{ asset('assets/brand/cppserum.png') }}" alt="Skin Care Icon">
            <p class="text-center">Serum</p>
         </div>
      </div>
      <div class="cell">
         <div class="top">Anti-agig</div>
         <div class="bottom">
            <img src="{{ asset('assets/brand/cppampoule.png') }}" alt="Skin Care Icon">
            <p class="text-center">Ampoule Plus (Twice a week)</p>
            <img src="{{ asset('assets/brand/cppampoule2.png') }}" alt="Skin Care Icon">
            <p class="text-center">Ampoule (5 times a week)</p>
         </div>
      </div>
      <div class="cell">
         <div class="top">Supplements elasticity and nutrition</div>
         <div class="bottom">
            <img src="{{ asset('assets/brand/cppcream3.png') }}" alt="Skin Care Icon">
            <p class="text-center">Cream</p>
            <img src="{{ asset('assets/brand/cppcream2.png') }}" alt="Skin Care Icon">
            <div class="d-flex justify-content-center align-items-center  bg-secondary bg-gradient text-white fw-bolder rounded-circle mx-auto px-2 py-0 fs-3"> +</div>
            <img src="{{ asset('assets/brand/cppcream.png') }}" alt="Skin Care Icon">
            <p class="text-center">DIY Sleeping Pack</p>
         </div>
      </div>
      <div class="cell">
         <div class="top">Enhences absorption</div>
         <div class="bottom">
            <img src="{{ asset('assets/brand/cppqueen.png') }}" alt="Skin Care Icon">
            <p class="text-center">Cell's Queen</p>
         </div>
      </div>
      <div class="cell">
         <div class="top">Protects</div>
         <div class="bottom">
            <img src="{{ asset('assets/brand/cppsunscreen.png') }}" alt="Skin Care Icon">
            <p class="text-center">Sunscreen</p>
            <img src="{{ asset('assets/brand/cppsunfish.png') }}" alt="Skin Care Icon">
            <p class="text-center">Sunfinish</p>
         </div>
      </div>
   </div>
   <div class=" mt-5">
      <div class="line-arrow"></div>
   </div>
</div>

<!--====================== Main Ingredient Section-1============================-->
<div class="celigin-main-ingredient-section bg-image mt-5 ">
   <div class="container celigin-container">
      <div class="celigin-ingredient-wrapper">
         <div class="celigin-ingredient-header my-4">
            <h3 class="celigin-header-title">Main Ingredient</h3>
            <div class="celigin-header-line"></div>
         </div>
         <p class="celigin-unique-subtitle">Skin Care Ingredient Unique to CELIGIN</p>
         <h1 class="celigin-main-title mb-4">CosCor</h1>
      </div>
      <div class="celigin-content-row row mt-4">
         <div class="celigin-glass-column  d-flex justify-content-center align-items-center col-lg-6 col-md-12 order-md-2 order-lg-1">
            <img src="{{ asset('assets/brand/jar.png') }}" alt="CosCor Glass Image" class="celigin-glass-image">
         </div>
         <div class="celigin-benefits-column col-lg-6 col-md-12 order-md-1 order-lg-2 d-flex flex-column justify-content-start align-items-start">
            <div class="container celigin-benefits-container py-4">
               <div class="row">
                  <div class="col-12">
                     <div class="celigin-benefit-item d-flex align-items-start mb-3">
                        <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="celigin-check-icon me-3">
                        <p class="celigin-benefit-text mb-0 lh-sm">
                           Formulated with optimal formulations to benefit cells without cell culture.
                        </p>
                     </div>
                     <div class="celigin-benefit-item d-flex align-items-start mb-3">
                        <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="celigin-check-icon me-3">
                        <p class="celigin-benefit-text mb-0 lh-sm">Made from plant-based ingredients.</p>
                     </div>
                     <div class="celigin-benefit-item d-flex align-items-start mb-3">
                        <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="celigin-check-icon me-3">
                        <p class="celigin-benefit-text mb-0 lh-sm">Does not contain harmful substances.</p>
                     </div>
                     <div class="celigin-benefit-item d-flex align-items-start mb-3">
                        <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="celigin-check-icon me-3">
                        <p class="celigin-benefit-text mb-0 lh-sm">
                           Contains a large amount of growth factors, so you can expect practical effects.
                        </p>
                     </div>
                     <div class="celigin-benefit-item d-flex align-items-start mb-3">
                        <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="celigin-check-icon me-3">
                        <p class="celigin-benefit-text mb-0 lh-sm">
                           It is composed of small molecules, so it is effective for skin absorption.
                        </p>
                     </div>
                  </div>
               </div>
            </div>

         </div>
      </div>
   </div>
</div>


<!-- ===========================Main Ingredient Section-2========================== -->
<div class="celigin-ingredient-section-two container-fluid bg-image py-sm-0 py-md-2 py-lg-4 py-xl-5">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-12">
            <div class="celigin-ingredient-wrapper">
               <div class="celigin-ingredient-header my-4">
                  <h3 class="celigin-header-title">Main Ingredient</h3>
                  <div class="celigin-header-line"></div>
               </div>
               <p class="celigin-unique-subtitle">Skin Care Ingredient Unique to CELIGIN</p>
               <h1 class="celigin-main-title mb-4">CosCor</h1>
               <p class="celigin-description lh-sm">
                  CosCor is Made up of active ingredients that are absorbed into the skin <br>
                  and work on their own to keep cells healthy and strengthened.
               </p>
            </div>

         </div>
      </div>

      <div class="row justify-content-center">
         <div class="col-12 col-md-10 col-lg-12 text-center">
            <img src="{{ asset('assets/brand/igf.png') }}" class="celigin-main-image img-fluid" alt="CosCor IGF Image">
         </div>
      </div>

      <div class="row justify-content-center">
         <div class="col-12 col-lg-10">
            <div class="celigin-info-section">
               <div class="row align-items-center bg-white px-3 py-4">
                  <div class="col-12 col-md-4 text-center text-md-start mb-3 mb-md-0">
                     <p class="celigin-info-heading mb-0">
                        Bio Cosmetic Material <br>Based on Serum-Free Medium
                     </p>
                  </div>
                  <div class="col-12 col-md-8 text-center text-md-start">
                     <p class="celigin-info-text mb-0">
                        Activate skin regeneration with no chemical composition based on serum-free medium material
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- =============================Aging and Growth Factors Section============================ -->
<div class="celigin-aging-section container-fluid bg-image py-sm-0 py-md-2 py-lg-4 py-xl-5">
   <div class="container celigin-container">
      <div class="celigin-header-wrapper text-center d-flex flex-column align-items-center mt-2">
         <div class="celigin-section-header d-flex align-items-center justify-content-between w-75">
            <h3 class="celigin-section-title mb-0">Main Ingredient</h3>
            <div class="celigin-header-line flex-grow-1 ms-3 px-0"></div>
         </div>
         <p class="celigin-unique-subtitle my-4">Skin Care Ingredient Unique to CELIGIN</p>
         <h1 class="celigin-main-title fw-bold mb-5">CosCor</h1>
      </div>

      <div class="row celigin-content-row">
         <div class="col-lg-8 celigin-circle-column">
            <div class="d-flex justify-content-center">
               <div class="celigin-circle-container">
                  <div class="celigin-circle celigin-left-circle text-center">
                     <p class="celigin-circle-text">Cell renewal slows down when EGF production in the body is reduced.</p>
                     <p class="celigin-circle-text">Dead cells do not shed off, and dead skin cells pile up.</p>
                     <p class="celigin-circle-text">Wastes fill up empty spaces in between pores, causing wrinkles and aging.</p>
                  </div>
                  <div class="celigin-circle celigin-right-circle">
                     <p class="celigin-circle-text">Genes involved in the breakdown of collagen activate as we age.</p>
                     <p class="celigin-circle-text">The collagen layer cannot support the tissues underneath the skin, resulting in wrinkles.</p>
                  </div>
                  <div class="celigin-circle-overlap">Aging</div>
               </div>
            </div>
            <div class="row celigin-benefits-row mt-5 mx-lg-5">
               <div class="col-4 text-center">
                  <h3 class="celigin-benefit-title">Normalize skin regeneration cycle.</h3>
               </div>
               <div class="col-4 text-center">
                  <h3 class="celigin-benefit-title">Growth Factor: EGF, FGF, IGF.</h3>
               </div>
               <div class="col-4 text-center">
                  <h3 class="celigin-benefit-title">Accelerate collagen production.</h3>
               </div>
            </div>
         </div>
         <div class="col-lg-4 celigin-image-column d-flex flex-column align-items-center">
            <img src="{{ asset('assets/brand/aging.png') }}" alt="Aging" class="celigin-main-image img-fluid w-75">
            <div class="celigin-image-description mt-3 text-center">
               <p class="celigin-description-text fw-bold">Also, the location of absorption and activation differs according to the type of the growth factor.</p>
               <p class="celigin-description-text">So, you will get the result (when the three growth factors work together).</p>
               <p class="celigin-description-text text-danger fw-bold">This is only made possible with CosCor.</p>
            </div>
         </div>
      </div>
      <div class="row celigin-growth-factors-row mt-5 mx-lg-5 bg-white  ps-4">
         <div class="col-md-4 my-4">
            <h3 class="celigin-growth-factor-title mb-3">01 EGF: Epidermal Growth Factor</h3>
            <ul class="celigin-growth-factor-list list-unstyled">
               <li>Works on the epidermal layer.</li>
               <li>Strengthens the skin barrier and improves skin texture.</li>
               <li>Accelerates skin regeneration.</li>
               <li>A dermatologic ingredient prescribed after</li>
               <li>epidermization and laser peeling procedures.</li>
            </ul>
         </div>
         <div class="col-md-4 my-4">
            <h3 class="celigin-growth-factor-title mb-3">02 bFGF: Basic Fibroblast Growth Factor</h3>
            <ul class="celigin-growth-factor-list list-unstyled">
               <li>Works in the dermal layer.</li>
               <li>Activates collagen and elastin.</li>
               <li>Higher regenerative effects when used together with EGF.</li>
            </ul>
         </div>
         <div class="col-md-4 my-4">
            <h3 class="celigin-growth-factor-title mb-3">03 IGF: Insulin-like Growth Factor</h3>
            <ul class="celigin-growth-factor-list list-unstyled">
               <li>Works deeper in the dermal layer.</li>
               <li>Boosts the anti-aging effects of EGF and bFGF.</li>
               <li>Commonly found in hair loss prevention shampoos.</li>
            </ul>
         </div>
      </div>
   </div>
</div>

<!--======================== Permanent Luxury Section====================== -->
<div class="container-fluid bg-image py-5">
   <div class="container">
      <!-- Header Section -->
      <div class="text-center d-flex flex-column align-items-center mt-2">
         <div class="celigin-ingredient-header my-4">
            <h3 class="celigin-header-title">Main Ingredient</h3>
            <div class="celigin-header-line"></div>
         </div>
      </div>

      <!-- Content Section -->
      <div class="container my-5">
         <div class="row align-items-center my-3">
            <div class="col-12 text-center">
               <p class="celigin-unique-subtitle lh-sm">
                  Permanent Luxury is always CHANEL,<br> permanent Cosmetics?
               </p>
               <h1 class="responsive-title fw-bold mb-3">Always Coscor.</h1>
               <p class="lead celigin-unique-subtitle">
                  The permanent entrance to anti-aging, there is no exit.
               </p>
               <h1 class="responsive-title">Skin regeneration effect in skin cells</h1>
            </div>
            <div class="d-flex align-items-center justify-content-center mt-3">
               <div class="d-flex align-items-center justify-content-center w-40">
                  <div class="flex-grow-1 responsive-line"></div>
                  <h3 class="mb-0 mx-3">150% improves</h3>
                  <div class="flex-grow-1 responsive-line"></div>
               </div>
            </div>
         </div>
      </div>

      <!-- Image Section -->
      <div class="row align-items-center">
         <div class="col-md-4 mb-3">
            <div class="border responsive-border text-center">
               <img src="{{ asset('assets/brand/mk.png') }}" alt="CosCor 0%" class="img-fluid">
            </div>
         </div>
         <div class="col-md-4 mb-3">
            <div class="border responsive-border text-center">
               <img src="{{ asset('assets/brand/mk2.png') }}" alt="CosCor 5%" class="img-fluid">
            </div>
         </div>
         <div class="col-md-4 mb-3">
            <div class="border responsive-border text-center">
               <img src="{{ asset('assets/brand/mk3.png') }}" alt="CosCor 10%" class="img-fluid">
            </div>
         </div>
      </div>

      <!-- Footer Section -->
      <p class="text-center celigin-unique responsive-text my-5">
         CosCor Helps Skin Cell proliferation, effective in <strong>skin regeneration.</strong>
      </p>
   </div>
</div>


<!-- ==========================Product Comparison Section================== -->
<div class="container-fluid bg-image  py-5 mb-5">
   <div class="container">
      <div class="text-center d-flex flex-column align-items-center">
         <div class="celigin-ingredient-header my-4">
            <h3 class="celigin-header-title">Main Ingredient</h3>
            <div class="celigin-header-line"></div>
         </div>

         <div class="container text-center mb-5">
            <p class=" celigin-unique">Extraordinary newness <span class="fw-bold fs-1">CosCor</span></p>
            <p class="mt-5 celigin-unique fw-bold ">What makes it different from regular stem cell ingredients?</p>
            <p class="fs-4 mt-4 fw-sm">Removed the problems of regular stem cell ingredients, and maximized the content of active ingredients!</p>
         </div>

         <div class="row comparison-row no-gutters mx-4 position-relative">
            <div class="col-12 col-xl-6 d-flex align-items-center justify-content-center comparison-col">
               <div class="CosCor-container d-flex flex-column align-items-center justify-content-center">
                  <h1 class="text-white mt-5">CosCor</h1>
                  <div class="CosCor-content bg-white px-5 pt-5 fs-5">
                     <div class="d-flex flex-column align-items-center justify-content-center">
                        <p class="lh-base px-2" style="background-color: #FEEEC1;">Does not undergo cell culturing process.</p>
                        <p class="lh-base">Does not include animal serum, with minimized animal-derived ingredients, there is a low risk of causing <span style="background-color: #FEEEC1;">side effects in the body.</span></p>
                        <p class="lh-base"> <span style="background-color: #FEEEC1;">Maximized content of active ingredients</span> through artificial medium technology, with guaranteed effects.</p>
                        <p class="lh-base">Composed of 43 ingredients selected by bio-ingredient experts. Does not include unidentified ingredients. Only includes highly <span style="background-color: #FEEEC1;">safe ingredients.</span> </p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-12 col-xl-6 d-flex align-items-center justify-content-center comparison-col">
               <div class="culture-medium-container d-flex flex-column align-items-center justify-content-center">
                  <h2 class="text-dark mt-3 mx-5">Ingredient of culture medium for regular stem cells</h2>
                  <div class="culture-medium-content bg-white px-5 pt-3">
                     <div class="d-flex flex-column align-items-center justify-content-center fs-5">
                        <p class="lh-sm">Does not undergo cell culturing process.</p>
                        <p class="lh-sm">Does not include animal serum, with minimized animal-derived ingredients, there is a low risk of causing side effects in the body.</p>
                        <p class="lh-sm">Maximized content of active ingredients through artificial medium technology, with guaranteed effects.</p>
                        <p class="lh-sm">Composed of 43 ingredients selected by bio-ingredient experts. Does not include unidentified ingredients. Only includes highly safe ingredients.</p>
                     </div>
                  </div>
               </div>
            </div>

            <div class="overlapping-divs">
               <div class="vs px-4">VS</div>
               <div class="cell-culture">Cell Culture</div>
               <div class="derived-ingredients">Derived Ingredients</div>
               <div class="active-ingredients">Active Ingredients</div>
               <div class="safety">Safety</div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- =========================CosCor Information Section======================= -->
<div class="container-fluid bg-image py-sm-0 py-md-2 py-lg-3 py-xl-4 py-5">
   <div class="container">
      <div class="text-center d-flex flex-column align-items-center mt-2">
         <div class="celigin-ingredient-header my-4">
            <h3 class="celigin-header-title">Main Ingredient</h3>
            <div class="celigin-header-line"></div>
         </div>
         <p class="celigin-unique my-4">Skin Care Ingredient Unique to CELIGIN</p>
         <h1 class="fw-bold" style="font-size: 4rem;">CosCor</h1>
         <p class="celigin-unique lh-sm mb-5">CosCor also showed effective results in antioxidant Tests. <br>
            It is an excellent ingredient for anti-aging.</p>
      </div>
      <div class="my-container">
         <div class="info-row">
            <div class="info-title">CosCor is</div>
            <div class="info-description ms-5">
               It is a bio-ingredient that incorporates serum-free medium technology with a complex of various active substances that can awaken the activity of skin cells and skin stem cells.
            </div>
         </div>
       
         <div class="info-row">
            <div class="info-title ">CosCor can</div>
            <div class="info-description ms-5">
               Effective results in antioxidant tests. It is an excellent ingredient for anti-aging.
            </div>
         </div>
      </div>
   </div>
</div>

<!--================================ Product Section1 =========================== -->
<div class="container-fluid product-page bg-image bg-padding">
   <div class="container product-container">
      <div class="text-center d-flex flex-column align-items-center mt-2">
         <div class="celigin-section-header d-flex align-items-center justify-content-between w-75 my-5">
            <h3 class="celigin-section-title mb-0">Products</h3>
            <div class="celigin-header-line flex-grow-1 ms-3 px-0"></div>
         </div>
      </div>

      <div class="product-content row mt-5 px-0">
         <div class="product-image-section col-lg-6 product--image-section">
            <div class="product-image-wrapper">
               <img src="{{ asset('assets/brand/cp-goobye1.png') }}" alt="Celigin Radiant Foam Cleanser" class="border-bottom border-dark">
               <div class="product-detail1 container my-2 px-0">
                  <div class="row mb-3 ps-2">
                     <div class="col-md-7 left-col1 d-flex flex-column">
                        <h2 class="product-title1">CELIGIN RADIANT</h2>
                        <h2 class="product-subtitle1">FOAM CLEANSER</h2>
                     </div>
                     <div class="col-md-5 right-col1 d-flex justify-content-center align-items-center">
                        <div>
                           <small class="product-info1 d-block">Capacity: 160ml (70EA)</small>
                           <small class="product-info1 d-block">CosCor 5,000 ppm</small>
                        </div>
                     </div>
                  </div>
                  <div class="product-bottom1 ps-3">

                     <div class="feature">
                        <img src="{{ asset('assets/brand/checkb.svg') }}" alt="Check Icon" class="icon">
                        <span class="feature-text ps-2">Hypoallergenic <br> cleaning</span>
                     </div>
                     <div class="feature">
                        <img src="{{ asset('assets/brand/checkb.svg') }}" alt="Check Icon" class="icon">
                        <span class="feature-text ps-2">Deep <br>cleansing</span>
                     </div>
                     <div class="feature">
                        <img src="{{ asset('assets/brand/checkb.svg') }}" alt="Check Icon" class="icon">
                        <span class="feature-text ps-2">Cleansing after <br> Moisturize</span>
                     </div>
                  </div>
               </div>

            </div>
         </div>
         <div class="product-description-section col-lg-6 px-0">
            <div class="product-description-wrapper mt-5">
               <p class="product-righttitle1 lh-sm">CELIGIN RADIANT FOAM CLEANSER</p>
               <p class="product-headline1">Goodbye Dry Cleansers <br> After Cleansing <br> Goodbye Irritating Cleansers</p>
               <div class="product-details1">
                  <p class="product-feature lh-sm mb-4">Its pH 5.5 mild acidity cleanses without irritation.</p>
                  <p class="product-feature lh-sm mb-4">A small amount produces a fine, rich lather that gently and thoroughly removes dirt and dead skin cells.</p>
                  <p class="product-feature lh-sm mb-4">Contains hyaluronic acid for long-lasting moisturization after cleansing.</p>
                  <p class="product-feature lh-sm mb-4">Contains 10 plant-based essentials, so your skin won't feel dry after cleansing. Skin texture is softened after cleansing.</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!--================================ Product Section2 =========================== -->
<div class="container-fluid product-page bg-image  bg-padding">
   <div class="container product-container">
      <!-- Section Title -->
      <div class="text-center d-flex flex-column align-items-center mb-5">
         <div class="celigin-section-header d-flex align-items-center justify-content-between w-75">
            <h3 class="celigin-section-title mb-0">Products</h3>
            <div class="celigin-header-line flex-grow-1 ms-3 px-0"></div>
         </div>
      </div>

      <!-- Product Content -->
      <div class="product-content row">
         <!-- Left Section (Image and Features) -->
         <div class="product-image-section col-lg-6 product--image-section">
            <div class=" text-center product-image-wrapper">
               <img src="{{ asset('assets/brand/cp-brighting1.png') }}" alt="Celigin Brightening Peeling Toner Pad" class="img-fluid border-bottom border-dark">
               <div class="product-detail1 container my-2 px-0">
                  <div class="row mb-3 ps-2">
                     <div class="col-md-7 left-col1 d-flex flex-column">
                        <h3 class="product-title1 text-start" style="font-size: 32px;">CELIGIN BRIGHTENING</h3>
                        <h3 class="product-subtitle1 text-start" style="font-size: 32px;">PEELING TONER PAD</h3>
                     </div>
                     <div class="col-md-5 right-col1 d-flex justify-content-center align-items-center">
                        <div>
                           <small class="product-info1 d-block">Capacity: 160ml (70EA)</small>
                           <small class="product-info1 d-block">CosCor 5,000 ppm</small>
                        </div>
                     </div>
                  </div>
                  <div class="product-bottom1 ps-3">

                     <div class="feature2">
                        <img src="{{ asset('assets/brand/checkb.svg') }}" alt="Check Icon" class="icon">
                        <span class="feature-text ps-2">Moisturizing</span>
                     </div>
                     <div class="feature2">
                        <img src="{{ asset('assets/brand/checkb.svg') }}" alt="Check Icon" class="icon">
                        <span class="feature-text ps-2">Soothing</span>
                     </div>
                     <div class="feature2">
                        <img src="{{ asset('assets/brand/checkb.svg') }}" alt="Check Icon" class="icon">
                        <span class="feature-text ps-2">Exfoliating</span>
                     </div>
                     <div class="feature2">
                        <img src="{{ asset('assets/brand/checkb.svg') }}" alt="Check Icon" class="icon">
                        <span class="feature-text ps-2">Replacement <br> for toner</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- Right Section (Description) -->
         <div class="product-description-section col-lg-6">
            <div class="product-description-wrapper">
               <p class="fs-3 fw-bold">CELIGIN BRIGHTENING PEELING TONER PAD</p>
               <div class="product-details ps-4">
                  <ul class="product-feature-list">
                     <li>• It refines the skin's texture after cleansing.</li>
                     <li>• It is a non-acidic essence with a PH of 5.3.</li>
                     <li>• It can be used instead of toner to open the skin's path. (so it can accept good ingredients)</li>
                     <li>• It contains propolis extract instead of purified water, so it stays moisturized longer.</li>
                     <li>- While exfoliating products can be irritating Celigin Brightening Peeling Toner Pads are gentle enough to be used by the whole family.</li>
                     <li>• Triple hyaluronic acid deeply moisturizes the skin.</li>
                     <li>• AHA. PHA LHA for hypoallergenic exfoliation</li>
                     <li>• The embossed sheet allows you to care for all the wrinkles on your face.</li>
                     <li>• It is also excellent for use as a pack when you need quick care in the morning and evening.</li>
                     <li>• It is also great for use in summer when the skin feels hot due to sun exposure.</li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!--================================ Product Section3 =========================== -->
<div class="container-fluid product-page bg-image bg-padding">
   <div class="container product-container">
      <div class="text-center d-flex flex-column align-items-center">
         <div class="d-flex align-items-center justify-content-between w-75 mb-5">
            <h3 class="mb-0">Product</h3>
            <div class="custom-line flex-grow-1 ms-3 px-0"></div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-6 px-0 product-image-section product--image-section">
            <div class="product-image-wrapper">
               <img src="{{ asset('assets/brand/cpp.png') }}" alt="Celigin Timeless Oil Mist" class="product-image">

               <div class=" my-0 bg-white">
                  <!-- Top Section -->
                  <div class="row p-3">
                     <!-- Left Column -->
                     <div class="col-8 text-start">
                        <p class="top-title my-2">CELIGIN</p>
                        <p class="top-subtitle lh-sm my-2">TIMELESS OIL MIST</p>
                        <p class="top-description">Bright and anti-wrinkle for dual-function cosmetics.</p>
                     </div>
                     <!-- Right Column -->
                     <div class="col-4 right-column text-start">
                        <p class="capacity">Capacity: 50 ml.</p>
                        <p class="details">CosCor 5,000 ppm</p>
                     </div>
                  </div>

                  <!-- Bottom Section -->
                  <div class="bordered-div">
                     <div class="feature2">
                        <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="icon">
                        <span class="feature-text">Moisturizing</span>
                     </div>
                     <div class="feature2">
                        <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="icon">
                        <span class="feature-text">Wrinkle <br>reduction</span>
                     </div>
                     <div class="feature2">
                        <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="icon">
                        <span class="feature-text">24 Hours a mineral <br> of water</span>
                     </div>
                     <div class="feature2">
                        <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="icon">
                        <span class="feature-text">Superfine <br>Sense</span>
                     </div>
                  </div>

               </div>
            </div>
         </div>
         <div class="col-lg-6 product-description-section ps-5 mt-5">
            <h3>CELIGIN TIMELESS OIL MIST</h3>
            <h1 class="product-headline">A portable oil mist, An oil mist you can spray anywhere, anytime</h1>

            <p class="product-description fs-3">In Korea, people prefer to have glowing skin. When the skin is tired from the external environment such as fine dust, it is a product that nourishes the skin from time to time to have moisturized and glowing skin all day long.</p>
            <p class="product-description fs-3  ">Seven kinds of vegedata oils are made fine by solid fermentation for 240 hours, and the small molecular microparticles are quickly absorbed deep into the skin, instantly delivering nutrition to the skin and providing moisturized and glowing skin for a long time. (Fermented like kimchi to maximize ingredients)</p>
         </div>
      </div>
   </div>
</div>

<!--================================ Product Section4 =========================== -->

<div class="celigin-product-section bg-image ">
   <div class="container product--cont">
      <div class="text-center d-flex flex-column align-items-center">
         <div class="d-flex align-items-center justify-content-between w-75 mb-5">
            <h3 class="mb-0">Product</h3>
            <div class="custom-line flex-grow-1 ms-3 px-0"></div>
         </div>
      </div>
      <div class="row product--row align-items-center">
         <div class="col-md-6 text-center">
            <img src="{{ asset('assets/brand/cpp11.png') }}"
               alt="Celigin Radiant Foam Cleanser"
               class="celigin-product-section__image">
         </div>

         <div class="col-md-6 celigin-product-section__details">
            <h3 class="celigin-product-section__name">CELIGIN Re Frush Gelling Mask</h3>
            <h3 class="celigin-product-section__headline">Superla Seaweed Gelling Mask</h3>

            <h3 class="fw-bold">
               Tencel Cupra Material + Seaweed Extract.
               Natural Water Storage. Provides high adhesion and soft texture.
            </h3>

            <p class="celigin-product-section__description">
               This pack contains the most seawater. Your skin needs to be full of moisture to feel revitalized.
            </p>

            <p class="celigin-product-section__description">
               To revitalize and firm the skin, the product contains seaweed extract,
               which is good for sensitive and dry skin. For tired skin or in need of calming,
               you should definitely use the Celigin Refreshing Gelling Mask Pack.
            </p>

            <p class="celigin-product-section__description">
               It will hydrate and healing.
            </p>
         </div>
      </div>
   </div>
</div>

<!--================================ Product Section5 =========================== -->
<div class="celigin-products-section container-fluid bg-image bg-padding">
   <div class="container product--cont" style="max-width: 1250px;">
      <div class="text-center d-flex flex-column align-items-center">
         <div class="d-flex align-items-center justify-content-between w-75 mb-5">
            <h3 class="mb-0">Product</h3>
            <div class="custom-line flex-grow-1 ms-3 px-0"></div>
         </div>
         <div class="container text-center mb-2">
            <p class="mt-5 celigin-unique fw-bold ">CELIGIN SIGNATURE CELL BIOME DUO</p>
            <p class="fs-4 mt-4 fw-sm"># Restoring whitening elasticity</p>
         </div>
         <div class="row product--row gx-5">
            <div class="col-md-6 product--image-section">
               <div class="celigin-product-card ">
                  <img src="{{ asset('assets/brand/cp-duo1.png') }}"
                     alt="Celigin Cell Up First Essence"
                     class="celigin-product-card__image img-fluid ">

                  <div class="product-container">
                     <div class="product-header5">
                        <p class="product-capacity5">Capacity: 50ml / CosCor: 10,000 ppm</p>
                        <h2 class="product-title5 text-start">CELIGIN</h2>
                        <h2 class="product-name5 text-start">CELL UP FIRST ESSENCE</h2>
                        <p class="product-description5 text-start">Brightening and anti-wrinkle for dual-function cosmetics</p>
                     </div>

                     <div class="bordered-div5 container py-4 ps-3">
                        <div class="row g-3">
                           <div class="col-md-4 col-sm-6">
                              <div class="d-flex align-items-start">
                                 <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="icon5 me-2">
                                 <span class="feature-text5 text-start">
                                    Water <br> Formulation <br> Essence
                                 </span>
                              </div>
                           </div>
                           <div class="col-md-4 col-sm-6">
                              <div class="d-flex align-items-start">
                                 <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="icon5 me-2">
                                 <span class="feature-text5 text-start">
                                    Low Molecular <br> Weight Collagen
                                 </span>
                              </div>
                           </div>
                           <div class="col-md-4 col-sm-6">
                              <div class="d-flex align-items-start">
                                 <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="icon5 me-2">
                                 <span class="feature-text5 text-start">
                                    Highly <br> Concentrated Capsule Energy
                                 </span>
                              </div>
                           </div>
                           <div class="col-md-4 col-sm-6">
                              <div class="d-flex align-items-start">
                                 <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="icon5 me-2">
                                 <span class="feature-text5 text-start">
                                    Transparent <br> Radiance
                                 </span>
                              </div>
                           </div>
                           <div class="col-md-4 col-sm-6">
                              <div class="d-flex align-items-start">
                                 <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="icon5 me-2">
                                 <span class="feature-text5 text-start">
                                    The Secret to <br> Rejuvenation
                                 </span>
                              </div>
                           </div>
                        </div>
                     </div>

                  </div>
               </div>
            </div>

            <div class="col-md-6 product--image-section">
               <div class="celigin-product-card ">
                  <img src="{{ asset('assets/brand/cp-duo2.png') }}"
                     alt="Celigin Cell Up First Essence"
                     class="celigin-product-card__image img-fluid ">

                  <div class="product-container">
                     <div class="product-header5">
                        <p class="product-capacity5">Capacity: 50ml / CosCor: 10,000 ppm</p>
                        <h2 class="product-title5 text-start">CELIGIN</h2>
                        <h2 class="product-name5 text-start">VITAL SERUM</h2>
                        <p class="product-description5 text-start">Brightening and anti-wrinkle for dual-function cosmetics</p>
                     </div>

                     <div class="bordered-div5 py-5">
                        <div class="container">
                           <div class="row g-3">
                              <div class="col-md-6">
                                 <div class="d-flex align-items-center">
                                    <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="icon5 me-2">
                                    <span class="feature-text5">Resilience</span>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="d-flex align-items-center">
                                    <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="icon5 me-2">
                                    <span class="feature-text5">Lifting</span>
                                 </div>
                              </div>
                           </div>
                           <div class="row g-3 mt-4">
                              <div class="col-md-6">
                                 <div class="d-flex align-items-center">
                                    <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="icon5 me-2">
                                    <span class="feature-text5">V-line</span>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="d-flex align-items-center">
                                    <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="icon5 me-2">
                                    <span class="feature-text5">Juvenesce</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="celigin-product-details row w-100 mt-4 text-start">
               <div class="col-md-6 ps-4 product--image-section">
                  <p>
                     <strong>After cleansing, apply CELL UP FIRST ESSENCE.</strong>
                     CELL UP FIRST ESSENCE replenishes collagen, which is lost with age.
                     Low molecular weight collagen is more easily absorbed by the skin.
                     Improving moisture, wrinkles, elasticity, and brightness.
                  </p>
               </div>
               <div class="col-md-6 ps-4 product--image-section">
                  <p>
                     <strong>CELL UP FIRST ESSENCE Use as the next step.</strong>
                     Vital Serum contains yam root extract. This plant-based mucin helps
                     moisturize, soothe, and firm. It also contains lactic acid bacteria
                     to support the skin's immune system. It is a favorite product of
                     Korean consumers as it provides both dryness relief and lifting effect.
                  </p>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


<!-- =============================================product section6=========================================== -->

<div class="container-fluid bg-image bg-padding">
   <div class="container product--cont ">
      <div class="text-center d-flex flex-column align-items-center mb-5">
         <div class="d-flex align-items-center justify-content-between w-75 mb-5">
            <h3 class="mb-0">Product</h3>
            <div class="custom-line flex-grow-1 ms-3 px-0"></div>
         </div>
      </div>
      <div class="row product--row">
         <div class="col-5 ps-5 ms-5 ">
            <img src="{{ asset('assets/brand/cpp6.png') }}" alt="Celigin High-End Ampoule Set" class="w-90 border border-dark border-2">
            <div class="product-info-container">
               <div class="product-header6 ps-4 pt-3">
                  <h2 class="">CELIGIN</h2>
                  <h2 class="">HIGH-END AMPOULE SET</h2>
                  <p class="product-description pb-3">Brightening and anti-wrinkle for dual-function cosmetics</p>
               </div>
            </div>
            <div class="product-details mt-3">
               <p class="product-capacity">Ampoule Plus - Capacity: 7ml*2ea / CosCor: 100,000 ppm</p>
               <p class="product-capacity">Ampoule - Capacity: 7ml*5ea / CosCor: 100,000 ppm</p>
            </div>
         </div>
         <div class="col-6">
            <p class="fs-4 fw-bold mb-5">CELIGIN HIGH-END AMPOULE SET</p>
            <p class="fw-bold fs-1 lh-sm mb-5">Supplement CosCor rich nutrients to witness a total change in your skin the next day</p>
            <div class="fs-3">
               <p>The Secret to Getting Younger 7 products, one at a time:</p>
               <p>Monday, Tuesday - High End Ampoule</p>
               <p>Wednesday - High End Ampoule Plus</p>
               <p>Thursday, Friday, Saturday - High End Ampoule</p>
               <p>Sunday - High End Ampoule Plus4</p>
               <p>weeks total program</p>
               <p class="lh-sm mt-5">Daily and Specialty Care. A two-product special package. Moisturizes without stickiness through multiple layers. Propolis extract. Moisturizing, densifying, firming, face-lifting, barrier, and finishing care all at once.</p>
            </div>
         </div>
      </div>
   </div>
</div>

<!--================================product section7=========================== -->


<div class="container-fluid bg-image bg-padding">
   <div class="container product--cont">
      <div class="text-center d-flex flex-column align-items-center">
         <div class="celigin-section-header d-flex align-items-center justify-content-between w-75">
            <h3 class="celigin-section-title mb-0">Products</h3>
            <div class="celigin-header-line flex-grow-1 ms-3 px-0"></div>
         </div>
         <div class="container text-center mb-2">
            <p class="mt-5 celigin-unique fw-bold ">CELIGIN HIGH-END AMPOULE SET</p>
         </div>
      </div>
      <div class="row product--row">
         <div class="col-md-6 px-5">
            <img src="{{ asset('assets/brand/cpp71.png') }}" alt="Celigin High-End Ampoule Set" class="img-fluid">
            <div class="bg-white p-4 detail-container7">
               <h3 class="font-weight-bold mb-3 title7">CELIGIN HIGH-END AMPOULE SET</h3>
               <div class="content-wrapper7">
                  <div class="item7 mb-3">
                     <p class="number7">01</p>
                     <p class="description7">Concentrated with skin regenerating ingredient CosCor</p>
                  </div>
                  <div class="item7 mb-3">
                     <p class="number7">02</p>
                     <p class="description7">Highly enriched with propolis extract, excellent for boosting skin immunity</p>
                  </div>
                  <div class="item7 mb-3">
                     <p class="number7">03</p>
                     <p class="description7">Clinically tested to improve skin texture, improve skin barrier, and improve anti-aging</p>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6 content-container7 px-3 mt-4">
            <h2 class="">Care aligned with the 28-day skin renewal cycle (turnover)</h2>
            <div>
               <p class="fs-5 mb-1 ">- Ingredients certified EPF95 Level 1 </p>
               <p class="fs-5 mb-1 ">by the American Academy of Dermatology</p>
               <p class="fs-5 mb-1 ">- Super anti-aging benefits</p>
            </div>
            <img src="{{ asset('assets/brand/cpp72.png') }}" alt="Skin Renewal Cycle" class=" image7 mb-3">
            <div class="cycle-info7">
               <h3>Skin renewal cycle:</h3>
               <p class="fs-5 mb-1">2 weeks for healthy cells to be born and grow</p>
               <p class="fs-5 mb-1">2 weeks for cells to naturally shed and regenerate</p>
               <p class="fs-5 mb-1">Total: 28 days of cycle-specific care</p>
            </div>
            <p class="additional-info7 mt-4">
               High-end Ampoule Plus Special Care twice a week<br>
               High-end Ampoule Deliverer Care
            </p>
         </div>
      </div>
   </div>
</div>

<!-- =============================================product section8================================== -->
<div class="container-fluid bg-image bg-padding">
   <div class="container product--cont">
      <div class="celigin-ingredient-wrapper">
         <div class="celigin-section-header d-flex align-items-center justify-content-between w-75">
            <h3 class="celigin-section-title mb-0">Products</h3>
            <div class="celigin-header-line flex-grow-1 ms-3 px-0"></div>
         </div>
         <h2 class=" my-5">CELIGIN HIGH-END AMPOULE</h2>
      </div>
      <div class="row product--row">
         <div class="col-6">
            <img src="{{ asset('assets/brand/cp-duo3.png') }}" class="img-fluid" alt="Celigin High-End Ampoule">
         </div>
         <div class="col-6">
            <p class="section-title8 ">Starting from the basics</p>
            <div class="row align-items-center my-3">
               <div class="col-4  ">
                  <img src="{{ asset('assets/brand/n1.png') }}" class="img-fluid feature-img" alt="Propolis Extract">
               </div>
               <div class="col-8">
                  <h5 class="feature-title">#Propolis extract</h5>
                  <p class="feature-description">Propolis extract that exceeds purified water in protecting the skin from the outer environment and strengthening the skin immunity. Creates a moisture barrier to maintain skin moisture.</p>
               </div>
            </div>
            <div class="row align-items-center my-3">
               <div class="col-4">
                  <img src="{{ asset('assets/brand/n2.png') }}" class="img-fluid feature-img" alt="Hemp Seed Oil">
               </div>
               <div class="col-8">
                  <h5 class="feature-title">#Hemp Seed Oil</h5>
                  <p class="feature-description">A rising star in the world of clean beauty. Optimized for prevention of skin oxidation, enhances skin regeneration and skin barrier. No-clogging of pores, suitable for oily skin!</p>
               </div>
            </div>
            <div class="row align-items-center my-3">
               <div class="col-4">
                  <img src="{{ asset('assets/brand/n3.png') }}" class="img-fluid feature-img" alt="Fig Extract">
               </div>
               <div class="col-8">
                  <h5 class="feature-title">#Fig extract</h5>
                  <p class="feature-description">Fig extract is an excellent antioxidant that prevents aging and rejuvenates the skin, and protects the skin to add nourishment and vitality.</p>
               </div>
            </div>
            <div class="row justify-content-center align-items-center my-1">
               <div class="col-3 col-sm-3 col-md-2 text-center">
                  <img src="{{ asset('assets/brand/fig-1.png') }}" class="img-fluid feature-img" alt="Hyaluronic Acid">
               </div>
               <div class="col-3 col-sm-3 col-md-2 text-center">
                  <img src="{{ asset('assets/brand/lessthan.png') }}" class="img-fluid feature-img" alt="Kelp Extract">
               </div>
               <div class="col-3 col-sm-3 col-md-2 text-center">
                  <img src="{{ asset('assets/brand/fig2.png') }}" class="img-fluid feature-img" alt="Lettuce">
               </div>
            </div>


            <div class="text-center">
               <h4 class="section-highlight-title">Intense Moisturization</h4>
               <p class="section-highlight-description"><strong>Hyaluronic acid for intense moisturization?</strong><br>Kelp extract is rich in fucoidin, which boasts of a great moisturizing power. Immediately after application, <strong>it provides moisture and vitality to fill the skin with a youthful energy.</strong></p>
            </div>
         </div>
      </div>
   </div>
</div>

<!--======================================================== -->

<div class="container-fluid bg-image bg-padding">
   <div class="container product--cont">
      <div class="celigin-ingredient-wrapper">
         <div class="celigin-section-header d-flex align-items-center justify-content-between w-75">
            <h3 class="celigin-section-title mb-0">Products</h3>
            <div class="celigin-header-line flex-grow-1 ms-3 px-0"></div>
         </div>
         <h2 class=" my-5">CELIGIN HIGH-END AMPOULE PLUS</h2>
      </div>
      <div class="row align-items-center product--row">
         <div class="col-6 d-flex justify-content-center">
            <img src="{{ asset('assets/brand/cpp8.png') }}" class="img-fluid" alt="Celigin High-End Ampoule">
         </div>
         <div class="col-6">
            <p class="section-title8 ">Starting from the basics</p>
            <div class="row align-items-center my-3">
               <div class="col-4">
                  <img src="{{ asset('assets/brand/cpp83.png') }}" class="img-fluid" alt="Propolis Extract">
               </div>
               <div class="col-8">
                  <h4 class="feature-title">No-kidding to anti-aging</h4>
                  <h5 class="feature-title">#Chaga mushroom extract</h5>
                  <p class="feature-description">Super intense anti-aging with Chaga mushroom extract excellent in preventing skin damage and aging, and improving skin regeneration</p>
               </div>
            </div>
            <div class="row align-items-center my-3">
               <div class="col-4">
                  <img src="{{ asset('assets/brand/cpp82.png') }}" class="img-fluid" alt="Hemp Seed Oil">
               </div>
               <div class="col-8">
                  <h4 class="feature-title">Stop anti-oxidant</h4>
                  <h5 class="feature-title">#Turmeric root extract</h5>
                  <p class="feature-description">Also known as the "The gold growing on soil", Turmeric root extract removes anti-oxidants on skin, making your skin look younger</p>
               </div>
            </div>
            <div class="row align-items-center my-3">
               <div class="col-4">
                  <img src="{{ asset('assets/brand/cpp81.png') }}" class="img-fluid" alt="Fig Extract">
               </div>
               <div class="col-8">
                  <h4 class="feature-title">Skin Immunity Plus</h4>
                  <h5 class="feature-title">#Propolis Extract</h5>
                  <p class="feature-description">High propolis extract content provides antioxidant properties and soothing effect, strengthen skin immunity for supple and healthy skin</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- =====================================product section-9===================================== -->
<div class="container-fluid product-page bg-image bg-padding">
   <div class="container product-container">
      <div class="text-center d-flex flex-column align-items-center">
         <div class="d-flex align-items-center justify-content-between w-75 mb-5">
            <h3 class="mb-0">Product</h3>
            <div class="custom-line flex-grow-1 ms-3 px-0"></div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-6 px-0 product-image-section product--image-section">
            <div class="product-image-wrapper">
               <img src="{{ asset('assets/brand/cpp9.png') }}" alt="Celigin Timeless Oil Mist" class="product-image">

               <div class=" my-0 bg-white">
                  <!-- Top Section -->
                  <div class="row p-3">
                     <!-- Left Column -->
                     <div class="col-8 text-start">
                        <p class="top-title my-2 ">CELIGIN</p>
                        <p class="top-subtitle lh-sm my-2">ROYAL INTNSIVE CREAM</p>
                        <p class="top-description">Bright and anti-wrinkle for dual-function cosmetics.</p>
                     </div>
                     <!-- Right Column -->
                     <div class="col-4 right-column text-start">
                        <p class="capacity">Capacity: 50 ml.</p>
                        <p class="details">CosCor 5,000 ppm</p>
                     </div>
                  </div>

                  <!-- Bottom Section -->
                  <div class="bordered-div">
                     <div class="feature2">
                        <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="icon">
                        <span class="feature-text">Botox</span>
                     </div>
                     <div class="feature2">
                        <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="icon">
                        <span class="feature-text">Regenerating <br>cream</span>
                     </div>
                     <div class="feature2">
                        <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="icon">
                        <span class="feature-text">Firming <br>creams</span>
                     </div>
                     <div class="feature2">
                        <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="icon">
                        <span class="feature-text">Buttercream <br>Contains</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-6 product-description-section ps-5 mt-5">
            <h3 class="product-subtitle">CELIGIN ROYAL INTNSIVE CREAM</h3>
            <h1 class="product-headline">A SINGLE USE of BOTOX Radiation Cream, a giant effect for SKIN FIRMNESS</h1>
            <p class="product-description fs-3">It contains borphyrin, the ingredient in Botox,
               and a complex of 12 peptides.
               The more you apply, the firmer your skin becomes.
               The formula is not heavy and absorbs like butter,
               so it can be used daily.
               If you have dry skin, you can reapply several times
               on your face from time to time.
               This is a highly functional cream that
               you can feel the difference in your skin right away.
               Quick dryness may be addressed.</p>
         </div>
      </div>
   </div>
</div>

<!-- ==========================================product section10================================== -->
<div class="container-fluid product-page bg-image bg-padding">
   <div class="container product-container">
      <div class="text-center d-flex flex-column align-items-center">
         <div class="d-flex align-items-center justify-content-between w-75 mb-5">
            <h3 class="mb-0">Product</h3>
            <div class="custom-line flex-grow-1 ms-3 px-0"></div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-6 px-0 product-image-section product--image-section">
            <div class="product-image-wrapper">
               <img src="{{ asset('assets/brand/cpp10.png') }}" alt="Celigin Timeless Oil Mist" class="product-image">

               <div class=" my-0 bg-white">
                  <!-- Top Section -->
                  <div class="row p-3">
                     <!-- Left Column -->
                     <div class="col-8 text-start">
                        <p class="top-title my-3">CELIGIN</p>
                        <p class="top-subtitle lh-sm my-3">ALL DAY PERFECT SUNCREAM</p>
                        <p class="top-description">Whitening, anti-wrinkle, and sunscreen triple function cosmetics</p>
                     </div>
                     <!-- Right Column -->
                     <div class="col-4 right-column text-start">
                        <h5>SPF50+/ PA++++</h5>
                        <p class="capacity">Capacity: 50 ml.</p>
                        <p class="details">CosCor 1,000 ppm</p>
                     </div>
                  </div>

                  <!-- Bottom Section -->
                  <div class="bordered-div">
                     <div class="feature2">
                        <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="icon">
                        <span class="feature-text">Full <br> Protection </span>
                     </div>
                     <div class="feature2">
                        <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="icon">
                        <span class="feature-text">Family <br>sunscreen</span>
                     </div>
                     <div class="feature2">
                        <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="icon">
                        <span class="feature-text">Natural <br>Tone Up</span>
                     </div>

                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-6 product-description-section ps-5 mt-5">
            <h3>CELIGIN ALL DAY PERFECT SUNCREAM</h3>
            <h1 class="product-headline"> Can be used by people of all ages
               Triple function of whitening/
               wrinkle reduction/UV protection</h1>

            <p class="product-description fs-3">365 days a year, sunny, cloudy, rainy,
               Celigin All-Day Perfect Sunscreen is the perfect
               sunscreen for every day of the year,
               whether you're out and about or staying in.</p>
            <p class="product-description fs-3">It's safe for the whole family to use.</p>
            <p class="product-description fs-3">It's moisturizing and smooth to apply, eliminating the
               downsides of poor application and white cast.</p>
            <p class="product-description fs-3">It's safe for the whole family to use.</p>
            <p class="product-description fs-3">It also tones up naturally, so you can go out with just sunscreen.</p>
            <p class="product-description fs-3">*Mixed the pros of each type of sunscreen</p>
         </div>
      </div>
   </div>
</div>

<!-- ========================================================product sectopn-11========================================== -->
<div class="container-fluid product-page bg-image bg-padding">
   <div class="container product-container">
      <div class="text-center d-flex flex-column align-items-center ">
         <div class="d-flex align-items-center justify-content-between w-75 mb-5">
            <h3 class="mb-0">Product</h3>
            <div class="custom-line flex-grow-1 ms-3 px-0"></div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-6 px-0 product-image-section product--image-section">
            <div class="product-image-wrapper">
               <img src="{{ asset('assets/brand/cpp111.png') }}" alt="Celigin Timeless Oil Mist" class="product-image">

               <div class=" my-0 bg-white">
                  <!-- Top Section -->
                  <div class="row p-3">
                     <!-- Left Column -->
                     <div class="col-8 text-start">
                        <p class="top-title my-3">CELIGIN</p>
                        <p class="top-subtitle lh-sm my-3">DAILY SUNFINISH</p>
                        <p class="top-description">Whitening, anti-wrinkle, and sunscreen triple function cosmetics</p>
                     </div>
                     <!-- Right Column -->
                     <div class="col-4 right-column text-start">
                        <h5>SPF50+/ PA++++</h5>
                        <p class="capacity">Capacity: 50 ml</p>
                        <p class="details">CosCor 1,000 ppm</p>
                     </div>
                  </div>

                  <!-- Bottom Section -->
                  <div class="bordered-div">
                     <div class="feature2">
                        <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="icon">
                        <span class="feature-text">Foundation-free </span>
                     </div>
                     <div class="feature2">
                        <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="icon">
                        <span class="feature-text">Tone-Up </span>
                     </div>
                     <div class="feature2">
                        <img src="{{ asset('assets/brand/check-icon.svg') }}" alt="Check Icon" class="icon">
                        <span class="feature-text">Brightening</span>
                     </div>

                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-6 product-description-section ps-5 mt-5">
            <h3>CELIGIN DAILY SUNFINISH</h3>
            <h1 class="product-headline"> Color, texture, finish and
               UV blocking,
               all perfectly taken care of!
               YOUR EVERYDAY SUNSCREEN</h1>

            <p class="product-description fs-3">Smooth application for a natural, not artificial look
               Brightens and illuminates skin tone for a dewy finish
               It can cover skin concerns such as spots, blemishes,
               and dark circles.</p>
            <p class="product-description fs-3 ">A lightweight, full-blocking sunscreen BB cream</p>
            <p class="product-description fs-3 ">*Mixed the pros of each type of sunscreen</p>
         </div>
      </div>
   </div>
</div>

<!-- ========================================================product sectopn-12========================================== -->
<div class="container-fluid product-page bg-padding ">
   <div class="container ">
      <div class="text-center d-flex flex-column align-items-center ">
         <img src="{{ asset('assets/brand/cpp12.png') }}" alt="Celigin Timeless Oil Mist" class="image-fluid">

         <div class="d-flex align-items-center justify-content-between w-75 my-5">
            <h3 class="mb-0">CELIGN</h3>
            <div class="custom-line flex-grow-1 ms-3 px-0"></div>
            <P class="mt-2 ms-2">Look Forward To Tomorrow</P>
         </div>
      </div>
   </div>
</div>

<!-- ========================================================product sectopn-13========================================== -->
<div class="container-fluid product-page bg-padding ">
   <div class="container ">
      <div class="text-center d-flex flex-column align-items-center ">
         <img src="{{ asset('assets/brand/cpp13.png') }}" alt="Celigin Timeless Oil Mist" class="image-fluid">

         <div class="d-flex align-items-center justify-content-between w-75 my-5">
            <h3 class="mb-0">CELIGN</h3>
            <div class="custom-line flex-grow-1 ms-3 px-0"></div>
            <P class="mt-2 ms-2">Look Forward To Tomorrow</P>
         </div>
      </div>
   </div>
</div>

<!-- ========================================================product sectopn-14========================================== -->
<div class="container-fluid product-page bg-padding">
   <div class="container ">
      <div class="text-center d-flex flex-column align-items-center ">
         <img src="{{ asset('assets/brand/cpp14.png') }}" alt="Celigin Timeless Oil Mist" class="image-fluid">

         <div class="d-flex align-items-center justify-content-between w-75 my-5">
            <h3 class="mb-0">CELIGN</h3>
            <div class="custom-line flex-grow-1 ms-3 px-0"></div>
            <P class="mt-2 ms-2">Look Forward To Tomorrow</P>
         </div>
      </div>
   </div>
</div>
<!-- ========================================================product sectopn-15========================================== -->
<div class="container-fluid product-page bg-padding">
   <div class="container ">
      <div class="text-center d-flex flex-column align-items-center ">
         <img src="{{ asset('assets/brand/cpp15.png') }}" alt="Celigin Timeless Oil Mist" class="image-fluid">

         <div class="d-flex align-items-center justify-content-between w-75 my-5">
            <h3 class="mb-0">CELIGN</h3>
            <div class="custom-line flex-grow-1 ms-3 px-0"></div>
            <P class="mt-2 ms-2">Look Forward To Tomorrow</P>
         </div>
      </div>
   </div>
</div>

<!-- ========================================================product sectopn-16========================================== -->
<div class="container-fluid product-page bg-padding">
   <div class="container ">
      <div class="text-center d-flex flex-column align-items-center ">
         <img src="{{ asset('assets/brand/cpp16.png') }}" alt="Celigin Timeless Oil Mist" class="image-fluid">

         <div class="d-flex align-items-center justify-content-between w-75 my-5">
            <h3 class="mb-0">CELIGN</h3>
            <div class="custom-line flex-grow-1 ms-3 px-0"></div>
            <P class="mt-2 ms-2">Look Forward To Tomorrow</P>
         </div>
      </div>
   </div>
</div>
<!-- ========================================================product sectopn-17========================================== -->
<div class="container-fluid product-page bg-padding">
   <div class="container ">
      <div class="text-center d-flex flex-column align-items-center ">
         <img src="{{ asset('assets/brand/cpp17.png') }}" alt="Celigin Timeless Oil Mist" class="image-fluid">

         <div class="d-flex align-items-center justify-content-between w-75 my-5">
            <h3 class="mb-0">CELIGN</h3>
            <div class="custom-line flex-grow-1 ms-3 px-0"></div>
            <P class="mt-2 ms-2">Look Forward To Tomorrow</P>
         </div>
      </div>
   </div>
</div>
<!-- ========================================================product sectopn-18========================================== -->
<div class="container-fluid product-page bg-padding">
   <div class="container ">
      <div class="text-center d-flex flex-column align-items-center ">
         <img src="{{ asset('assets/brand/cpp18.png') }}" alt="Celigin Timeless Oil Mist" class="image-fluid">

         <div class="d-flex align-items-center justify-content-between w-75 my-5">
            <h3 class="mb-0">CELIGN</h3>
            <div class="custom-line flex-grow-1 ms-3 px-0"></div>
            <P class="mt-2 ms-2">Look Forward To Tomorrow</P>
         </div>
      </div>
   </div>
</div>

<!-- ========================================================product sectopn-19========================================== -->
<div class="container-fluid product-page bg-padding ">
   <div class="container ">
      <div class="text-center d-flex flex-column align-items-center ">
         <img src="{{ asset('assets/brand/cpp19.png') }}" alt="Celigin Timeless Oil Mist" class="image-fluid">

         <div class="d-flex align-items-center justify-content-between w-75 my-5">
            <h3 class="mb-0">CELIGN</h3>
            <div class="custom-line flex-grow-1 ms-3 px-0"></div>
            <P class="mt-2 ms-2">Look Forward To Tomorrow</P>
         </div>
      </div>
   </div>
</div>
<!-- ========================================================product sectopn-20========================================== -->
<div class="container-fluid product-page bg-image bg-padding">
   <div class="container product-container">
      <div class="text-center d-flex flex-column align-items-center ">
         <div class="d-flex align-items-center justify-content-between w-75 mb-5">
            <h3 class="mb-0">Product</h3>
            <div class="custom-line flex-grow-1 ms-3 px-0"></div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-6 px-0 product-image-section product--image-section">
            <div class="product-image-wrapper">
               <img src="{{ asset('assets/brand/cpp20.png') }}" alt="Celigin Timeless Oil Mist" class="product-image">

               <div class=" my-0 bg-white">
                  <!-- Top Section -->
                  <div class="row p-3">
                     <!-- Left Column -->
                     <div class="col-8 text-start">
                        <p class="top-title my-3">CELIGIN</p>
                        <p class="top-subtitle lh-sm my-3">DAILY SUNFINISH</p>
                        <p class="top-description">Whitening, anti-wrinkle, and sunscreen triple function cosmetics</p>
                     </div>
                     <!-- Right Column -->
                     <div class="col-4 right-column text-start">
                        <h5>SPF50+/ PA++++</h5>
                        <p class="capacity">Capacity: 50 ml</p>
                        <p class="details">CosCor 1,000 ppm</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-6 product-description-section ps-5 mt-5">
            <h3>CELIGIN CELL'S QUEEN</h3>
            <h1 class="product-headline"> COMPLETELY REBORN
               CELUV GALVANIC PRODUCTS</h1>
            <p class="product-description fs-3">It helps the active ingredients of cosmetics to be
               absorbed deeper into the skin. </p>
            <p class="product-description fs-3 ">When applying cosmetics, When fatigue builds up,
               When you need to massage your skin, wrinkles, etc.
               It can be used on the face, body, or both.
            </p>
            <p class="product-description fs-3 ">It can be used semi-permanently with Type C
               charging. It's lightweight and portable, so you can take
               it anywhere.</p>
            <p class="product-description fs-3 "> In particular, the wave line is designed to conform to
               the contours of the face.It has a US and European
               design patent, US FDA registration, and European CE
               registration.</p>
         </div>
      </div>

      <div class="row custom-gap22 justify-content-end">

         <div class="col-lg-9 d-flex align-items-center">
            <div class="row">
               <!-- First Section (Left Part) -->
               <div class="col-md-6">
                  <div class="row">
                     <!-- Image on the left side -->
                     <div class="col-md-4">
                        <img src="{{ asset('assets/brand/cppl20.png') }}" alt="Wave Head Device" class="img-fluid image-container22">
                     </div>

                     <!-- Text on the right side -->
                     <div class="col-md-8 mt-4 ps-5">
                        <h3 class="mb-3">Wave Head</h3>
                        <ul class="list-unstyled">
                           <li>Mode 1 - Galvanic ion + Vibration</li>
                           <li>Mode 2 - Microcurrents + Vibration</li>
                           <li>Mode 3 - Heating + Vibration</li>
                        </ul>
                     </div>
                  </div>
               </div>

               <!-- Second Section (Right Part) -->
               <div class="col-md-6">
                  <div class="row ">
                     <!-- Text on the left side -->
                     <div class="col-md-8 mt-4">
                        <h3 class="mb-3">V Head</h3>
                        <ul class="list-unstyled">
                           <li>Mode 1 - Galvanic ion + Vibration</li>
                           <li>Mode 2 - Microcurrents + Vibration</li>
                           <li>Mode 3 - Heating + Vibration</li>
                        </ul>
                     </div>

                     <!-- Image on the right side -->
                     <div class="col-md-4">
                        <img src="{{ asset('assets/brand/cppr20.png') }}" alt="V Head Device" class="img-fluid image-container22">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

   </div>
</div>

<!-- ========================================================product sectopn-21========================================= -->
<div class="container-fluid bg-image bg-padding">
   <div class="container">
      <div class="text-center d-flex flex-column align-items-center mb-5">
         <div class="celigin-section-header d-flex align-items-center justify-content-between w-75">
            <h3 class="celigin-section-title mb-0">Products</h3>
            <div class="celigin-header-line flex-grow-1 ms-3 px-0"></div>
         </div>
         <h2 class="fw-bold my-5" style="font-size: 3rem;">Cell's Quenn Core Function</h1>
      </div>

      <div class="container">
         <div class="galvanic21 bg-white pt-4 px-4 d-flex flex-column align-items-start">
            <div class="galvanic-top21 w-70 d-flex justify-content-between align-items-center">
               <div class="left left px-5 fs-3 fw-bold">Galvanic</div>
               <div class="right fs-5 text-center">A function that absorbs the active ingredients of cosmetics into the skin.</div>
            </div>

            <div class="galvanic-bottom21 text-start mt-3">
               *Iontophoresis: It penetrates the active ingredients of cosmetics deeply into the skin by generating a potential difference in the skin, just like the principle of a magnet that pushes the same pole and pulls the other pole.
            </div>
            <img class="galvanic-image21 position-absolute" src="{{ asset('assets/brand/cppt21.png') }}" alt="Galvanic Image" />
         </div>

         <div class="vibration21 bg-white my-3 px-4">

         </div>
         <div class="vibration21 bg-white my-3 px-4">

         </div>

         <div class="vibration21 bg-white my-3 px-4">
            <div class="left px-5 fs-3 fw-bold">Vibration</div>
            <div class="right fs-5" style="max-width: 60%;">Vibration is generated for all functions to promote blood circulation, collagen production, and skin elasticity, and different vibrations are generated for each function to maximize the effect.</div>
            <img class="vibration-image21" src="{{ asset('assets/brand/cppb21.png') }}" alt="Vibration Image" />
         </div>
      </div>
   </div>
</div>
<!-- ========================================================product sectopn-22========================================= -->
<div class=" container-fluid bg-image bg-padding">
   <div class="container celigin-container">
      <div class="celigin-header-wrapper text-center d-flex flex-column align-items-center mt-2">
         <div class="celigin-section-header d-flex align-items-center justify-content-between w-75">
            <h3 class="celigin-section-title mb-0">Products</h3>
            <div class="celigin-header-line flex-grow-1 ms-3 px-0"></div>
         </div>
         <h3 class="celigin-main-title fw-bold">HOW TO USE</h3>
         <p class="celigin-unique-subtitle my-4">Apply skincare products to skin and massage with cell's queen</p>
      </div>
      <div class="container my-5">
         <div class="step-grid">
            <div class="step-card">
               <img src="{{ asset('assets/brand/cf221.png') }}" alt="Step 1">
               <h5>Glabella, Forehead</h5>
               <p>Glide the device upward from the eyebrows and temple to massage the forehead area. Galvanic ion mode, Microcurrent mode.</p>
               <ul class="d-flex flex-wrap">
                  <li class="green me-3">Galvanic ion mode</li>
                  <li class="green">Microcurrent mode</li>
               </ul>

            </div>
            <div class="step-card">
               <img src="{{ asset('assets/brand/cf222.png') }}" alt="Step 2">
               <h5>Cheeks, Smile Lines, Areas Near the Lips</h5>
               <p>Glide the device on smile lines, areas near the lips and cheeks, and massage. Galvanic ion mode, Microcurrent mode.</p>
               <ul class="d-flex flex-wrap">
                  <li class="green me-3">Galvanic ion mode</li>
                  <li class="green">Microcurrent mode</li>
               </ul>
            </div>
            <div class="step-card">
               <img src="{{ asset('assets/brand/cf223.png') }}" alt="Step 3">
               <h5>Eyes</h5>
               <p>Put a little pressure and massage the areas near the eyes, from the front corner to the edges of the eyes. Galvanic ion mode, Microcurrent mode.</p>
               <ul class="d-flex flex-wrap">
                  <li class="green me-3">Galvanic ion mode</li>
                  <li class="green">Microcurrent mode</li>
               </ul>
            </div>
            <div class="step-card">
               <img src="{{ asset('assets/brand/cf224.png') }}" alt="Step 4">
               <h5>Neckline, Cucullaris</h5>
               <p>Put a little pressure and massage the neckline, lymphatic vessels in cucullaris, and the shoulder line. Heating mode.</p>
               <ul>
                  <li class="red">Heating mode</li>
               </ul>
            </div>
            <div class="step-card">
               <img src="{{ asset('assets/brand/cf225.png') }}" alt="Step 5">
               <h5>Collarbone</h5>
               <p>Gently massage the desired area along the collarbones in an outward direction. Heating mode.</p>
               <ul>
                  <li class="red">Heating mode</li>
               </ul>
            </div>
            <div class="step-card">
               <img src="{{ asset('assets/brand/cf226.png') }}" alt="Step 6">
               <h5>Jawline</h5>
               <p>From the bottom of the jaw, glide the device following the face line and massage. Galvanic ion mode, Microcurrent mode, Heating mode.</p>
               <ul>
                  <li class="red">Heating mode</li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- ========================================================product section-23========================================= -->
<div class=" container-fluid bg-image bg-padding">
   <div class="container celigin-container">
      <div class="celigin-header-wrapper text-center d-flex flex-column align-items-center mt-2">
         <div class="celigin-section-header d-flex align-items-center justify-content-between w-75">
            <h3 class="celigin-section-title mb-0">Cell's Queen</h3>
            <div class="celigin-header-line flex-grow-1 ms-3 px-0"></div>
         </div>
         <h3 class="celigin-main-title fw-bold">HOW TO USE</h3>
         <p class="celigin-unique-subtitle my-4">Apply skincare products to skin and massage with cell's queen</p>
      </div>
      <div class="container">
         <div class="row">
            <div class="col-lg-8 d-flex-center">
               <img src="{{ asset('assets/brand/cpp23.png') }}" alt="Responsive Image" class="img-fluid">
            </div>
            <div class="col-lg-4 d-flex justify-content-center align-items-center">
               <img src="{{ asset('assets/brand/ytqr.png') }}" alt="QR Code" class="qr-code">
            </div>

         </div>
      </div>
   </div>
</div>
<!-- ========================================================product section-24========================================= -->
<div class=" container-fluid bg-image bg-padding">
   <div class="ingredient-section">
      <div class="container">
         <div class="row">
            <div class="col-md-4">
               <img src="{{ asset('assets/brand/gmp.png') }}" class="img-fluid" alt="GMP">
               <h5>GMP</h5>
            </div>
            <div class="col-md-4">
               <img src="{{ asset('assets/brand/cpnp.png') }}" class="img-fluid" alt="DERMATEST Completed">
               <h5>DERMATEST Completed</h5>
            </div>
            <div class="col-md-4">
               <img src="{{ asset('assets/brand/exellent.png') }}" class="img-fluid" alt="CPNP">
               <h5>European Cosmetics Certifier Registered with CPNP</h5>
            </div>
         </div>
      </div>
   </div>
</div>

@includeIf('partials.global.common-footer')
@endsection